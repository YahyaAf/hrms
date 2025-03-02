<?php

namespace App\Http\Controllers;

use App\Models\Carriere;
use App\Models\User;
use Illuminate\Http\Request;

class CarriereController extends Controller
{
    public function index()
    {
        $carrieres = Carriere::with('user', 'formation')->paginate(10);
        return view('carrieres.index', compact('carrieres'));
    }

    public function show($id)
    {
        $carriere = Carriere::with('user', 'formation')->findOrFail($id);
        return view('carrieres.show', compact('carriere'));
    }

    public function edit($user_id)
    {
        $carriere = Carriere::where('user_id', $user_id)->firstOrFail();
        $grades = \App\Models\Grade::all(); 

        return view('carrieres.edit', compact('carriere', 'grades')); 
    }


    public function update(Request $request, $user_id)
    {
        $request->validate([
            'promotion' => 'required|exists:grades,id', 
            'augmentation' => 'required|numeric|min:0', 
        ]);

        $carriere = Carriere::where('user_id', $user_id)->firstOrFail();
        $carriere->update([
            'promotion' => $request->promotion, 
            'augmentation' => $request->augmentation, 
        ]);

        $user = User::findOrFail($user_id);
        $user->grade_id = $request->promotion; 
        $user->salaire = $request->augmentation; 
        $user->save(); 

        return redirect()->route('carrieres.index')->with('success', 'Promotion et augmentation mises à jour avec succès.');
    }

}
