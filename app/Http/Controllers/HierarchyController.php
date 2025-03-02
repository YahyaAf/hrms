<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Departement;
use App\Models\Grade;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class HierarchyController extends Controller
{
    public function index()
    {
        $admin = User::role('admin')->first(); 
        $departments = Departement::with('users.grade')->get();
        $grades = Grade::orderByDesc('level')->get(); 
        return view('hierarchy.index', compact('admin', 'departments', 'grades'));
    }
}
