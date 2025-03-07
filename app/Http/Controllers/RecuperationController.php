<?php

namespace App\Http\Controllers;

use App\Models\Recuperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class RecuperationController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:view-recuperation')->only(['index', 'show', 'soldeRecuperations']);
        $this->middleware('permission:create-recuperation')->only(['create', 'store']);
        $this->middleware('permission:gestion-recuperation')->only(['gestionRecuperations']);
        $this->middleware('permission:validate-recuperation')->only(['validateRh']);
        $this->middleware('permission:reject-recuperation')->only(['rejectRh']);
    }

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

    public function gestionRecuperations()
    {
        $recuperations = Recuperation::with(['user'])
            ->where('statut', 'En attente') 
            ->get();

        return view('recuperations.recuperation', compact('recuperations'));
    }

    public function validateRh($id)
    {
        $recuperation = Recuperation::findOrFail($id);
        $user = Auth::user(); 

        if (!$user->hasRole('RH')) {
            return redirect()->route('recuperations.gestion')->with('error', 'Accès non autorisé.');
        }

        $recuperation->validation_rh = true;
        $recuperation->save(); 
        $this->approuverRecuperation($recuperation);
        

        return redirect()->route('recuperations.gestion')->with('success', 'Validation RH mise à jour avec succès.');
    }

    private function approuverRecuperation($recuperation)
    {
        $user = $recuperation->user; 
        if ($user->solde_recuperation >= $recuperation->nombre_jours) {
            $user->solde_recuperation -= $recuperation->nombre_jours;
            $user->save(); 
            $recuperation->statut = 'Approuvé';
            $recuperation->save(); 

            return redirect()->route('recuperations.gestion')->with('success', 'Demande de récupération approuvée.');
        } else {
            $recuperation->statut = 'Rejeté';
            $recuperation->save(); 

            return redirect()->route('recuperations.gestion')->with('error', 'Solde insuffisant, demande de récupération rejetée.');
        }
    }

    public function rejectRh($id)
    {
        $recuperation = Recuperation::findOrFail($id);
        $user = Auth::user();

        if ($user->hasRole('RH')) {
            $recuperation->validation_rh = false;
            $recuperation->statut = 'Rejeté';
            $recuperation->save();

            return redirect()->route('recuperations.gestion')->with('success', 'Demande de récupération rejetée.');
        }

        return redirect()->route('recuperations.gestion')->with('error', 'Accès non autorisé.');
    }
}

