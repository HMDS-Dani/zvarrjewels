<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StorefrontController extends Controller
{
    /**
     * Storefront Homepage
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $featuredProducts = Product::with('category')->where('is_featured', true)->take(8)->get();
        $latestArrivals = Product::with('category')->latest()->take(8)->get();
        $recentReviews = Review::where('is_approved', true)->latest()->take(6)->get();

        return view('shop.home', compact('categories', 'featuredProducts', 'latestArrivals', 'recentReviews'));
    }

    /**
     * Full Jewellery Catalog & Shop Page
     */
    public function shop(Request $request)
    {
        $query = Product::with('category');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('material', 'like', "%{$search}%");
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $categorySlug = $request->category;
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Material Filter
        if ($request->filled('material')) {
            $query->where('material', 'like', "%{$request->material}%");
        }

        // Price Sort
        if ($request->filled('sort')) {
            if ($request->sort === 'price_low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_high') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'name') {
                $query->orderBy('name', 'asc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();
        $selectedCategory = $request->category ? Category::where('slug', $request->category)->first() : null;

        return view('shop.catalog', compact('products', 'categories', 'selectedCategory'));
    }

    /**
     * Category Specific Page
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->latest()->paginate(12);
        $categories = Category::withCount('products')->get();
        $selectedCategory = $category;

        return view('shop.catalog', compact('products', 'categories', 'selectedCategory'));
    }

    /**
     * Single Product Details Page
     */
    public function product($slug)
    {
        $product = Product::with(['category', 'reviews'])->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.product', compact('product', 'relatedProducts'));
    }

    /**
     * Customer Review Submission
     */
    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'name' => 'required|string|max:100',
            'city' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = Review::create([
            'product_id' => $validated['product_id'] ?? null,
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'city' => $validated['city'] ?? 'Pakistan',
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_verified_buyer' => true,
            'is_approved' => true,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your verified review has been submitted successfully.',
                'review' => $review,
            ]);
        }

        return redirect()->back()->with('review_success', 'Thank you! Your verified review has been submitted successfully.');
    }

    /**
     * About Us Page
     */
    public function about()
    {
        return view('shop.about');
    }

    /**
     * Contact Us Page
     */
    public function contact()
    {
        return view('shop.contact');
    }

    /**
     * Handle Customer Contact Message / Inquiry
     */
    public function submitContactInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:50',
            'topic' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'topic' => $validated['topic'] ?? 'General Inquiry',
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your message has been saved in our CRM.',
                'inquiry' => $inquiry,
            ]);
        }

        return redirect()->back()->with('inquiry_success', 'Your inquiry has been received! Our concierge team will contact you shortly.');
    }

    /**
     * Stream product image directly without bloating HTML response
     */
    public function productMedia($id)
    {
        $product = Product::find($id);
        if (! $product || empty($product->image)) {
            return redirect('https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800');
        }

        if (str_starts_with($product->image, 'http://') || str_starts_with($product->image, 'https://')) {
            return redirect($product->image);
        }

        if (preg_match('/^data:(image\/[a-zA-Z0-9\+\-]+);base64,(.+)$/s', $product->image, $matches)) {
            $mime = $matches[1];
            $binary = base64_decode($matches[2]);

            return response($binary, 200, [
                'Content-Type' => $mime,
                'Cache-Control' => 'no-cache, must-revalidate, max-age=0',
                'ETag' => md5($product->image),
            ]);
        }

        return redirect($product->image);
    }

    /**
     * Stream category image directly without bloating HTML response
     */
    public function categoryMedia($id)
    {
        $category = Category::find($id);
        if (! $category || empty($category->image)) {
            return redirect('https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600');
        }

        if (str_starts_with($category->image, 'http://') || str_starts_with($category->image, 'https://')) {
            return redirect($category->image);
        }

        if (preg_match('/^data:(image\/[a-zA-Z0-9\+\-]+);base64,(.+)$/s', $category->image, $matches)) {
            $mime = $matches[1];
            $binary = base64_decode($matches[2]);

            return response($binary, 200, [
                'Content-Type' => $mime,
                'Cache-Control' => 'no-cache, must-revalidate, max-age=0',
                'ETag' => md5($category->image),
            ]);
        }

        return redirect($category->image);
    }
}
