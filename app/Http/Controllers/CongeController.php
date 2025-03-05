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

    public function validateByManager($id)
    {
        $conge = Conge::findOrFail($id);

        if (auth()->user()->role !== 'manager') {
            return redirect()->route('conges.index')->with('error', 'Vous n\'êtes pas autorisé à valider ce congé.');
        }

        $conge->update([
            'status' => 'validé par manager',
        ]);

        return redirect()->route('conges.index')->with('success', 'Demande de congé validée par le manager.');
    }

    public function validateByRH($id)
    {
        $conge = Conge::findOrFail($id);

        if (auth()->user()->role !== 'rh') {
            return redirect()->route('conges.index')->with('error', 'Vous n\'êtes pas autorisé à valider ce congé.');
        }

        $conge->update([
            'status' => 'validé par RH',
        ]);

        return redirect()->route('conges.index')->with('success', 'Demande de congé validée par le service RH.');
    }

    public function soldeConges()
    {
        $user = auth()->user();
        return view('conges.solde', compact('user'));
    }
}
