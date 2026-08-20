<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminInquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(15);
        $newCount = Inquiry::where('status', 'new')->count();

        return view('admin.inquiries.index', compact('inquiries', 'newCount'));
    }

    public function updateStatus(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $request->validate([
            'status' => 'required|in:new,contacted,resolved',
        ]);

        $inquiry->update(['status' => $request->status]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Inquiry status updated successfully.',
                'inquiry' => $inquiry,
            ]);
        }

        return redirect()->back()->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Inquiry deleted successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Inquiry deleted successfully.');
    }
}
