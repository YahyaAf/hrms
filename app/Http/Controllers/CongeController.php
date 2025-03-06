<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Conge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
        $user = Auth::user();

        return view('conges.solde', compact('user'));
    }

    public function gestionConges()
    {
        $conges = Conge::with('user')->get();

        return view('conges.conge', compact('conges'));
    }




    public function accepterConge($id)
    {
        $conge = Conge::findOrFail($id);
        if (
            (auth()->user()->role === 'manager' && auth()->user()->departement_id === $conge->user->departement_id) ||
            (auth()->user()->role === 'rh' && auth()->user()->departement_id === $conge->user->departement_id)
        ) {
            if (auth()->user()->role === 'manager') {
                $conge->update(['validation_manager' => true]);
            }

            if (auth()->user()->role === 'rh') {
                $conge->update(['validation_rh' => true]);
            }
            if ($conge->validation_manager && $conge->validation_rh) {
                $conge->update(['statut' => 'Approuvé']);
            }

            return redirect()->back()->with('success', 'Le congé a été validé.');
        }

        return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation.');
    }



}
