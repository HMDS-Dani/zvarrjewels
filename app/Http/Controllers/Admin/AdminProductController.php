<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Display CRM Overview Dashboard
     */
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalStock = Product::sum('stock');
        $lowStockProducts = Product::where('stock', '<=', 5)->get();
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalStock',
            'lowStockProducts',
            'recentProducts'
        ));
    }

    /**
     * Display a listing of jewellery products
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('material', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new jewellery product
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created jewellery product in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|integer|min:0',
            'material' => 'required|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|url',
            'transparent_image_base64' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        // Process Image: Base64 Data URI (works 100% on Vercel Serverless & Local), uploaded file, or URL
        $imagePath = null;
        if ($request->filled('transparent_image_base64') && str_starts_with($request->input('transparent_image_base64'), 'data:image/')) {
            $imagePath = $request->input('transparent_image_base64');
        } elseif ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $mime = $file->getMimeType() ?: 'image/jpeg';
            $imagePath = 'data:'.$mime.';base64,'.base64_encode(file_get_contents($file->getRealPath()));
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        // Generate unique slug
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }

        Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'stock' => $validated['stock'],
            'material' => $validated['material'],
            'image' => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in database
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|integer|min:0',
            'material' => 'required|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'image_url' => 'nullable|url',
            'transparent_image_base64' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        // Process Image
        $imagePath = $product->image;
        if ($request->filled('transparent_image_base64') && str_starts_with($request->input('transparent_image_base64'), 'data:image/')) {
            $imagePath = $request->input('transparent_image_base64');
        } elseif ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $mime = $file->getMimeType() ?: 'image/jpeg';
            $imagePath = 'data:'.$mime.';base64,'.base64_encode(file_get_contents($file->getRealPath()));
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'stock' => $validated['stock'],
            'material' => $validated['material'],
            'image' => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Jewellery item updated with transparent background successfully!');
    }

    /**
     * Remove the specified product from database
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Jewellery item deleted from inventory.');
    }
}
