<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('product')->latest()->paginate(15);
        $products = Product::select('id', 'name')->orderBy('name')->get();

        return view('admin.reviews.index', compact('reviews', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'name' => 'required|string|max:100',
            'city' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
            'is_verified_buyer' => 'nullable|boolean',
            'is_approved' => 'nullable|boolean',
        ]);

        Review::create([
            'product_id' => $validated['product_id'] ?? null,
            'name' => $validated['name'],
            'city' => $validated['city'] ?? 'Pakistan',
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_verified_buyer' => $request->has('is_verified_buyer'),
            'is_approved' => $request->has('is_approved'),
        ]);

        return redirect()->back()->with('success', 'New customer review added successfully.');
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'name' => 'required|string|max:100',
            'city' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
            'is_verified_buyer' => 'nullable|boolean',
            'is_approved' => 'nullable|boolean',
        ]);

        $review->update([
            'product_id' => $validated['product_id'] ?? null,
            'name' => $validated['name'],
            'city' => $validated['city'] ?? 'Pakistan',
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_verified_buyer' => $request->has('is_verified_buyer'),
            'is_approved' => $request->has('is_approved'),
        ]);

        return redirect()->back()->with('success', 'Customer review updated successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Customer review deleted successfully.');
    }
}
