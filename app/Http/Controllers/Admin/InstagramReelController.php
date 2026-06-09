<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstagramReel;
use Illuminate\Http\Request;

class InstagramReelController extends Controller
{
    public function index()
    {
        $reels = InstagramReel::orderBy('sort_order')->get();
        return view('admin.reels.index', compact('reels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'reel_url'  => 'nullable|url',
            'likes'     => 'nullable|string|max:20',
        ]);

        $filename = time() . '_reel.' . $request->file('thumbnail')->getClientOriginalExtension();
        $request->file('thumbnail')->move(public_path('assets/images/reels'), $filename);

        InstagramReel::create([
            'thumbnail'  => $filename,
            'reel_url'   => $request->reel_url,
            'likes'      => $request->likes,
            'status'     => true,
            'sort_order' => InstagramReel::count(),
        ]);

        return back()->with('success', 'Reel added successfully.');
    }

    public function destroy(InstagramReel $instagramReel)
    {
        $path = public_path('assets/images/reels/' . $instagramReel->thumbnail);
        if (file_exists($path)) unlink($path);
        $instagramReel->delete();
        return back()->with('success', 'Reel deleted.');
    }
}
