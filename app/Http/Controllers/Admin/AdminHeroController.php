<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroPhoto;
use Illuminate\Http\Request;

class AdminHeroController extends Controller
{
    private const MAX_PHOTOS = 5;

    public function index()
    {
        $heroPhotos = HeroPhoto::orderBy('order')->get();
        return view('admin.hero.index', compact('heroPhotos'));
    }

    public function create()
    {
        if (HeroPhoto::count() >= self::MAX_PHOTOS) {
            return redirect()->route('admin.hero.index')
                ->with('error', 'Maksimal ' . self::MAX_PHOTOS . ' foto hero. Hapus salah satu terlebih dahulu.');
        }
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        if (HeroPhoto::count() >= self::MAX_PHOTOS) {
            return redirect()->route('admin.hero.index')
                ->with('error', 'Maksimal ' . self::MAX_PHOTOS . ' foto hero. Hapus salah satu terlebih dahulu.');
        }

        $request->validate([
            'image'   => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'caption' => 'nullable|string|max:255',
            'order'   => 'nullable|integer|min:0|max:99|unique:hero_photos,order',
        ]);

        $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/hero'), $imageName);

        HeroPhoto::create([
            'image'     => 'uploads/hero/' . $imageName,
            'caption'   => $request->caption,
            'order'     => $request->order ?? HeroPhoto::max('order') + 1,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.hero.index')->with('success', 'Foto hero berhasil ditambahkan.');
    }

    public function edit(HeroPhoto $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, HeroPhoto $hero)
    {
        $request->validate([
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'caption' => 'nullable|string|max:255',
            'order'   => 'nullable|integer|min:0|max:99|unique:hero_photos,order,' . $hero->id,
        ]);

        $data = [
            'caption'   => $request->caption,
            'order'     => $request->order ?? $hero->order,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($hero->image && file_exists(public_path($hero->image))) {
                @unlink(public_path($hero->image));
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/hero'), $imageName);
            $data['image'] = 'uploads/hero/' . $imageName;
        }

        $hero->update($data);

        return redirect()->route('admin.hero.index')->with('success', 'Foto hero berhasil diperbarui.');
    }

    public function destroy(HeroPhoto $hero)
    {
        if ($hero->image && file_exists(public_path($hero->image))) {
            @unlink(public_path($hero->image));
        }

        $hero->delete();

        return redirect()->route('admin.hero.index')->with('success', 'Foto hero berhasil dihapus.');
    }
}
