<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emploi;
use App\Models\Departement;
use App\Http\Requests\EmploiRequest;

class EmploiController extends Controller
{
    public function index(){

        $emplois = Emploi::with('departement')->get();
        return view('emplois.index',compact('emplois'));
    }

    public function create(){

        $departements = Departement::all();
        return view('emplois.create', compact('departements'));
    }

    public function store(EmploiRequest $request){

        Emploi::create($request->validated());
        return redirect()->route('emplois.index')->with('success', 'Emploi créé avec succès.');
    }

    public function show(Emploi $emploi){
        return view('emplois.show',compact('emploi'));
    }

    public function edit(Emploi $emploi){

        $departements = Departement::all();
        return view('emplois.edit',compact('departements','emploi'));
    }

    public function update(EmploiRequest $request, Emploi $emploi)
    {
        $emploi->update($request->validated());
        return redirect()->route('emplois.index')->with('success', 'Emploi mis à jour avec succès.');
    }

    public function destroy(Emploi $emploi){

        $emploi->delete();
        return redirect()->route('emplois.index')->with('success', 'Emploi modifier avec succès.');
    }
}
