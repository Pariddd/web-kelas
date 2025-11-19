<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query params (with defaults)
        $q = (string) $request->query('q', '');
        $event = (string) $request->query('event', '');
        $sortBy = (string) $request->query('sort_by', 'created_at');
        $sortDir = (string) $request->query('sort_dir', 'desc');
        $perPage = (int) $request->query('per_page', 10);

        // sanitize perPage — allow only specific options
        $allowedPerPage = [5, 10, 20, 50];
        if (! in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        // allowed sort columns to avoid SQL injection
        $allowedSorts = ['title', 'event', 'created_at'];
        if (! in_array($sortBy, $allowedSorts, true)) {
            $sortBy = 'created_at';
        }

        $sortDir = strtolower($sortDir) === 'asc' ? 'asc' : 'desc';

        // Build query
        $query = Gallery::query();

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', '%' . $q . '%')
                    ->orWhere('event', 'like', '%' . $q . '%');
            });
        }

        if ($event !== '') {
            $query->where('event', $event);
        }

        // You can eager load relations here if you have them, e.g. ->with('user')

        // Order and paginate
        $galleries = $query->orderBy($sortBy, $sortDir)
            ->paginate($perPage)
            ->withQueryString(); // keep q,event,sort_by,... on links

        // For the cards: counts
        $galleryCount = Gallery::count();

        // if you have a Member model, replace this.
        $memberCount = 0;
        try {
            if (class_exists(\App\Models\Member::class)) {
                $memberCount = \App\Models\Member::count();
            }
        } catch (\Throwable $e) {
            // fail safe: don't break page if member model missing
            Log::debug('Member count skipped: ' . $e->getMessage());
        }

        // Distinct event list for the event filter dropdown
        $eventsList = Gallery::whereNotNull('event')
            ->where('event', '!=', '')
            ->select('event')
            ->distinct()
            ->orderBy('event')
            ->pluck('event');

        // Pass variables expected by the Blade view
        return view('admin.gallery.index', [
            'galleries'    => $galleries,
            'eventsList'   => $eventsList,
            'q'            => $q,
            'event'        => $event,
            'sortBy'       => $sortBy,
            'sortDir'      => $sortDir,
            'perPage'      => $perPage,
            'galleryCount' => $galleryCount,
            'memberCount'  => $memberCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'event' => 'nullable|string|max:100',
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ],
            [
                'title.required' => 'The image name is required.',
                'event.string' => 'The event must be a string.',
                'image.image' => 'The image must be an image file.',
                'image.max' => 'The image size must not exceed 2MB.',
            ]
        );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $gallery = Gallery::create($validatedData);

        return redirect()->route('gallery.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {

            // Delete old image
            if ($gallery->image && file_exists(public_path('img_item_upload/' . $gallery->image))) {
                unlink(public_path('img_item_upload/' . $gallery->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload'), $imageName);
            $validated['image'] = $imageName;
        }

        $gallery->update($validated);

        return redirect()->route('gallery.index')->with('success', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('gallery.index')
            ->with('success', 'Gallery item deleted successfully.');
    }
}
