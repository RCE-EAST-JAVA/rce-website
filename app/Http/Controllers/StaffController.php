<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('role', 'like', '%' . $search . '%')
                  ->orWhere('expertise', 'like', '%' . $search . '%');
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $staffs = $query->orderBy('sort_order')->orderBy('name')->paginate(8);

        return view('staff.index', compact('staffs'));
    }

    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }
}
