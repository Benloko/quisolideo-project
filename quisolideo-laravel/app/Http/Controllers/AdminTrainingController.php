<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class AdminTrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::orderBy('created_at','desc')->get();
        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        return view('admin.trainings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'slug'=>'required|string|max:255|unique:trainings,slug',
            'short_description'=>'nullable|string',
            'content'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'gallery_videos' => 'nullable|array',
            'gallery_videos.*' => 'file|mimes:mp4,webm,mov|max:51200',
            'seats'=>'nullable|integer',
            'price'=>'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('trainings', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $training = Training::create($data);

        $firstGalleryPath = null;
        if ($request->hasFile('gallery_images')) {
            $sortOrder = 0;
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('trainings/gallery', 'public');
                $publicPath = '/storage/' . $path;
                $training->images()->create([
                    'path' => $publicPath,
                    'sort_order' => $sortOrder++,
                ]);

                if ($firstGalleryPath === null) {
                    $firstGalleryPath = $publicPath;
                }
            }
        }

        if (!$training->image && $firstGalleryPath) {
            $training->update(['image' => $firstGalleryPath]);
        }

        if ($request->hasFile('gallery_videos')) {
            $sortOrder = 0;
            foreach ($request->file('gallery_videos') as $file) {
                $path = $file->store('trainings/videos', 'public');
                $publicPath = '/storage/' . $path;
                $training->videos()->create([
                    'path' => $publicPath,
                    'description' => null,
                    'sort_order' => $sortOrder++,
                ]);
            }
        }

        return redirect()->route('admin.trainings.index')->with('success','Formation créée');
    }

    public function edit(Training $training)
    {
        $training->load(['images', 'videos']);
        return view('admin.trainings.edit', compact('training'));
    }

    public function update(Request $request, Training $training)
    {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'slug'=>'required|string|max:255|unique:trainings,slug,'.$training->id,
            'short_description'=>'nullable|string',
            'content'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'gallery_videos' => 'nullable|array',
            'gallery_videos.*' => 'file|mimes:mp4,webm,mov|max:51200',
            'video_descriptions' => 'nullable|array',
            'video_descriptions.*' => 'nullable|string|max:2000',
            'seats'=>'nullable|integer',
            'price'=>'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('trainings', 'public');
            $data['image'] = '/storage/' . $path;
        } else {
            unset($data['image']);
        }

        $training->update($data);

        $firstNewGalleryPath = null;
        if ($request->hasFile('gallery_images')) {
            $nextSortOrder = (int) ($training->images()->max('sort_order') ?? -1) + 1;
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('trainings/gallery', 'public');
                $publicPath = '/storage/' . $path;
                $training->images()->create([
                    'path' => $publicPath,
                    'sort_order' => $nextSortOrder++,
                ]);

                if ($firstNewGalleryPath === null) {
                    $firstNewGalleryPath = $publicPath;
                }
            }
        }

        if (!$training->image && $firstNewGalleryPath) {
            $training->update(['image' => $firstNewGalleryPath]);
        }

        if ($request->has('video_descriptions')) {
            $descriptions = (array) $request->input('video_descriptions', []);
            foreach ($training->videos as $video) {
                if (!array_key_exists($video->id, $descriptions)) {
                    continue;
                }

                $desc = $descriptions[$video->id];
                $desc = $desc !== null ? trim((string) $desc) : null;

                $video->update([
                    'description' => $desc !== '' ? $desc : null,
                ]);
            }
        }

        if ($request->hasFile('gallery_videos')) {
            $nextSortOrder = (int) ($training->videos()->max('sort_order') ?? -1) + 1;
            foreach ($request->file('gallery_videos') as $file) {
                $path = $file->store('trainings/videos', 'public');
                $publicPath = '/storage/' . $path;
                $training->videos()->create([
                    'path' => $publicPath,
                    'description' => null,
                    'sort_order' => $nextSortOrder++,
                ]);
            }
        }

        return redirect()->route('admin.trainings.index')->with('success','Formation mise à jour');
    }

    public function destroy(Training $training)
    {
        $training->delete();
        return redirect()->route('admin.trainings.index')->with('success','Formation supprimée');
    }
}
