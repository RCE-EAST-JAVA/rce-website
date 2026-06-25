<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::query();

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('role', 'like', '%' . $request->search . '%')
                  ->orWhere('affiliation', 'like', '%' . $request->search . '%')
                  ->orWhere('expertise', 'like', '%' . $request->search . '%');
        }

        // Filter afiliasi/klasifikasi universitas
        if ($request->has('affiliation') && $request->affiliation != '') {
            $query->where('affiliation', 'like', '%' . $request->affiliation . '%');
        }

        $staffs = $query->latest()->paginate(8);

        return view('staff.index', compact('staffs'));
    }
}
