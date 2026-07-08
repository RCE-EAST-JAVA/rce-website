<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class AdminPartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {
            $logoName = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/partners'), $logoName);
            $data['logo'] = 'uploads/partners/' . $logoName;
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner added successfully.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {
            if ($partner->logo && file_exists(public_path($partner->logo))) {
                @unlink(public_path($partner->logo));
            }
            $logoName = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/partners'), $logoName);
            $data['logo'] = 'uploads/partners/' . $logoName;
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo && file_exists(public_path($partner->logo))) {
            @unlink(public_path($partner->logo));
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
    }
}
