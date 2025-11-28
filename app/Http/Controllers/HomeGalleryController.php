<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeGalleryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 20;
        $query = Gallery::query();

        if ($request->filled('year')) {
            $query->whereYear('date', $request->input('year'));
        }

        if ($request->filled('event')) {
            $query->where('event', 'like', '%' . $request->input('event') . '%');
        }

        $galleries = $query->latest('date')->paginate($perPage);

        $years = Gallery::selectRaw('YEAR(date) as year')
            ->whereNotNull('date')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->filter();

        return view('members.gallery', compact('galleries', 'years'));
    }

    public function data(Request $request)
    {
        $perPage = 20;
        $query = Gallery::query();

        if ($request->filled('year')) {
            $query->whereYear('date', $request->input('year'));
        }

        if ($request->filled('event')) {
            $query->where('event', 'like', '%' . $request->input('event') . '%');
        }

        $galleries = $query->latest('date')->paginate($perPage);

        $items = $galleries->map(function ($gallery) {
            return [
                'id' => $gallery->id,
                'image' => $gallery->image
                    ? asset('img_item_upload/' . $gallery->image)
                    : 'https://placehold.co/600x800/1f2937/ffffff?text=No+Image',
                'event' => $gallery->event,
                'year' => $gallery->date ? \Carbon\Carbon::parse($gallery->date)->format('Y') : '-',
                'created_at' => $gallery->date
                    ? \Carbon\Carbon::parse($gallery->date)->toIso8601String()
                    : $gallery->created_at->toIso8601String(),
            ];
        });

        return response()->json([
            'data' => $items,
            'current_page' => $galleries->currentPage(),
            'last_page' => $galleries->lastPage(),
            'per_page' => $galleries->perPage(),
            'total' => $galleries->total(),
        ]);
    }
}
