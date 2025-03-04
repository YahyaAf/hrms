<?php

namespace App\Http\Controllers;

use App\Models\Carriere;
use App\Models\User;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CarriereController extends BaseController
{
    public function __construct()
    {
        $this->middleware('can:create-carriere')->only(['create', 'store']);
        $this->middleware('can:edit-carriere')->only(['edit', 'update']);
        $this->middleware('can:view-carriere')->only(['show']);
    }

    // Afficher le formulaire pour ajouter une nouvelle carrière
    public function create($user_id = null)
    {
        $users = User::all();
        $grades = Grade::all();
        $carriere = null;

        if ($user_id) {
            // Optionally, you can pass the user if you want to create a career for a specific user
            $user = User::findOrFail($user_id);
        }

        return view('carrieres.create', compact('users', 'grades', 'carriere', 'user'));
    }

    // Ajouter une nouvelle carrière et mettre à jour l'utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grade_id' => 'required|exists:grades,id',
            'augmentation' => 'required|numeric|min:0',
        ]);

        // Créer la nouvelle carrière
        $carriere = Carriere::create([
            'user_id' => $request->user_id,
            'grade_id' => $request->grade_id,
            'augmentation' => $request->augmentation,
        ]);

        // Mettre à jour l'utilisateur avec le nouveau grade et salaire
        $user = User::findOrFail($request->user_id);
        $user->update([
            'grade_id' => $request->grade_id,
            'salaire' => $request->augmentation,
        ]);

        return redirect()->route('carrieres.show', $carriere->id)->with('success', 'Carrière ajoutée avec succès.');
    }

    // Afficher une carrière spécifique
    public function show($user_id)
    {
        $carrieres = Carriere::where('user_id', $user_id)->get();
        return view('carrieres.show', compact('carrieres', 'user_id'));
    }




    // Modifier une carrière existante
    public function edit($id)
    {
        $carriere = Carriere::findOrFail($id);
        $grades = Grade::all();

        return view('carrieres.edit', compact('carriere', 'grades'));
    }

    // Mettre à jour une carrière spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'augmentation' => 'required|numeric|min:0',
        ]);

        $carriere = Carriere::findOrFail($id);
        $carriere->update([
            'grade_id' => $request->grade_id,
            'augmentation' => $request->augmentation,
        ]);

        return redirect()->route('carrieres.show', $carriere->id)->with('success', 'Carrière mise à jour avec succès.');
    }
}
