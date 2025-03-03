<?php

namespace App\Http\Controllers;

use App\Models\Carriere;
use App\Models\User;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controller as BaseController;

class CarriereController extends BaseController
{
    public function __construct()
    {
        $this->middleware('can:view-carriere')->only(['index', 'show']);
        $this->middleware('can:create-carriere')->only(['create', 'store']);
        $this->middleware('can:edit-carriere')->only(['edit', 'update']);
        $this->middleware('can:delete-carriere')->only(['destroy']);
    }

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
        if (!Gate::allows('edit-carriere')) {
            abort(403);
        }

        $carriere = Carriere::where('user_id', $user_id)->firstOrFail();
        $grades = Grade::all(); 

        return view('carrieres.edit', compact('carriere', 'grades')); 
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id', 
            'augmentation' => 'required|numeric|min:0', 
        ]);

        $carriere = Carriere::where('user_id', $user_id)->firstOrFail();
        $carriere->update([
            'grade_id' => $request->grade_id, 
            'augmentation' => $request->augmentation, 
        ]);

        $user = User::findOrFail($user_id);
        $user->grade_id = $request->grade_id; 
        $user->salaire = $request->augmentation; 
        $user->save(); 

        return redirect()->route('carrieres.index')->with('success', 'Promotion et augmentation mises à jour avec succès.');
    }

    public function destroy($user_id)
    {
        if (!Gate::allows('delete-carriere')) {
            abort(403);
        }

        $carriere = Carriere::where('user_id', $user_id)->firstOrFail();
        $carriere->delete();

        return redirect()->route('carrieres.index')->with('success', 'Carrière supprimée avec succès.');
    }
}
