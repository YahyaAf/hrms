<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use Illuminate\Routing\Controller as BaseController;

class GradeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:view-grades')->only(['index', 'show']);
        $this->middleware('permission:create-grades')->only(['create', 'store']);
        $this->middleware('permission:edit-grades')->only(['edit', 'update']);
        $this->middleware('permission:delete-grades')->only('destroy');
    }

    public function index()
    {
        $grades = Grade::all();
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        return view('grades.create');
    }

    public function store(GradeRequest $request)
    {
        Grade::create($request->validated());
        return redirect()->route('grades.index')->with('success', 'Grade ajouté avec succès.');
    }

    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    public function update(GradeRequest $request, Grade $grade)
    {
        $grade->update($request->validated());
        return redirect()->route('grades.index')->with('success', 'Grade modifié avec succès.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade supprimé avec succès.');
    }
}
