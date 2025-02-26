<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartementRequest;
use Illuminate\Http\Request;
use App\Models\Departement;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departements = Departement::all();
        return view('departements.index',compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartementRequest $request)
    {
        Departement::create($request->validated());
        return redirect()->route('departements.index')->with('success', 'Département créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        return view('departements.show',compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        return view('departements.edit',compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartementRequest $request,Departement $departement)
    {
        $departement->update($request->validated());
        return redirect()->route('departements.index')->with('sucess','Département modifier avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
