<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class AdminStaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::latest()->paginate(10);
        return view('admin.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'affiliation' => 'required|string|max:255',
            'expertise' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/staff'), $imageName);
            $data['image'] = 'uploads/staff/' . $imageName;
        }

        Staff::create($data);

        return redirect()->route('admin.staff.index')->with('success', 'Staf berhasil ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'affiliation' => 'required|string|max:255',
            'expertise' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($staff->image && file_exists(public_path($staff->image))) {
                @unlink(public_path($staff->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/staff'), $imageName);
            $data['image'] = 'uploads/staff/' . $imageName;
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'Profil staf berhasil diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->image && file_exists(public_path($staff->image))) {
            @unlink(public_path($staff->image));
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staf berhasil dihapus.');
    }
}
