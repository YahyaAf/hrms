<?php

namespace App\Http\Controllers;

use App\Models\Recuperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecuperationController extends Controller
{
    public function index()
    {
        $recuperations = Recuperation::where('user_id', Auth::id())->get();
        return view('recuperations.index', compact('recuperations'));
    }

    public function create()
    {
        return view('recuperations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => ['required', 'date', 'after_or_equal:' . now()->addWeek()->format('Y-m-d')],  
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],  
        ], [
            'date_debut.after_or_equal' => 'Vous devez choisir une date de début d\'au moins une semaine à l\'avance.',  
            'date_fin.after_or_equal' => 'La date de fin doit être après la date de début.',  
        ]);

        $dateDebut = \Carbon\Carbon::parse($request->date_debut);
        $dateFin = \Carbon\Carbon::parse($request->date_fin);

        $nombreJours = 0;
        while ($dateDebut <= $dateFin) {
            if ($dateDebut->isWeekday()) {
                $nombreJours++;
            }
            $dateDebut->addDay();
        }

        Recuperation::create([
            'user_id' => Auth::id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'nombre_jours' => $nombreJours,
            'validation_rh' => false,
            'statut' => 'En attente',
        ]);

        return redirect()->route('recuperations.index')->with('success', 'Demande de récupération envoyée.');
    }



    public function show($id)
    {
        $recuperation = Recuperation::findOrFail($id);
        return view('recuperations.show', compact('recuperation'));
    }

    public function soldeRecuperations()
    {
        $user = Auth::user();

        return view('recuperations.solde', compact('user'));
    }

    public function validateRh($id)
    {
        $recuperation = Recuperation::findOrFail($id);
        $user = Auth::user();

        if ($user->hasRole('RH')) {
            $recuperation->validation_rh = true;
            $recuperation->statut = 'Approuvé';
            $recuperation->save();

            return redirect()->route('recuperations.index')->with('success', 'Demande de récupération approuvée.');
        }

        return redirect()->route('recuperations.index')->with('error', 'Accès non autorisé.');
    }

    public function rejectRh($id)
    {
        $recuperation = Recuperation::findOrFail($id);
        $user = Auth::user();

        if ($user->hasRole('RH')) {
            $recuperation->validation_rh = false;
            $recuperation->statut = 'Rejeté';
            $recuperation->save();

            return redirect()->route('recuperations.index')->with('success', 'Demande de récupération rejetée.');
        }

        return redirect()->route('recuperations.index')->with('error', 'Accès non autorisé.');
    }
}

