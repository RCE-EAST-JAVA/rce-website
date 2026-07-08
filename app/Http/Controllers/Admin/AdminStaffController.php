<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class AdminStaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::orderBy('sort_order')->orderBy('name')->paginate(10);
        return view('admin.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'role'        => 'required|string|max:255',
            'category'    => 'required|in:Research Assistant,Researcher',
            'expertise'   => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email'       => 'nullable|email|max:255',
            'linkedin'    => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'role', 'category', 'expertise', 'description', 'email', 'linkedin', 'sort_order']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/staff'), $imageName);
            $data['image'] = 'uploads/staff/' . $imageName;
        }

        Staff::create($data);

        return redirect()->route('admin.staff.index')->with('success', 'Person added successfully.');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'role'        => 'required|string|max:255',
            'category'    => 'required|in:Research Assistant,Researcher',
            'expertise'   => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email'       => 'nullable|email|max:255',
            'linkedin'    => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'role', 'category', 'expertise', 'description', 'email', 'linkedin', 'sort_order']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            if ($staff->image && file_exists(public_path($staff->image))) {
                @unlink(public_path($staff->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/staff'), $imageName);
            $data['image'] = 'uploads/staff/' . $imageName;
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'Person profile updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->image && file_exists(public_path($staff->image))) {
            @unlink(public_path($staff->image));
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Person deleted successfully.');
    }
}
