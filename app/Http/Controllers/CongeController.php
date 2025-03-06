<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conge;
use Illuminate\Http\Request;
use Carbon\Carbon;



class CongeController extends Controller
{
    public function index()
    {
        $conges = Conge::where('user_id', auth()->id())->get();
        return view('conges.index', compact('conges'));
    }

    public function create()
    {
        return view('conges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => ['required', 'date', 'after_or_equal:' . now()->addWeek()->format('Y-m-d')],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],
            'type_conge' => ['required', 'string'],
            'motif' => ['nullable', 'string'],
        ], [
            'date_debut.after_or_equal' => 'Vous devez choisir une date de début d\'au moins une semaine à l\'avance.',
            'date_fin.after_or_equal' => 'La date de fin doit être après la date de début.',
        ]);

        Conge::create([
            'user_id' => auth()->id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'jours_demandes' => Carbon::parse($request->date_debut)->diffInDays(Carbon::parse($request->date_fin)) + 1,
            'type_conge' => $request->type_conge,
            'motif' => $request->motif,
            'statut' => 'En attente',
        ]);

        return redirect()->route('conges.index')->with('success', 'Demande de congé soumise avec succès.');
    }


    public function show($id)
    {
        $conge = Conge::findOrFail($id);
        return view('conges.show', compact('conge'));
    }

    public function soldeConges()
    {
        return view('conges.solde');
    }
}
