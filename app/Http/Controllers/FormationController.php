<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::paginate(10); 
        return view('formations.index', compact('formations'));
    }


    public function create()
    {
        $users = User::all(); 
        return view('formations.create', compact('users'));
    }

    public function store(StoreFormationRequest $request)
    {
        $data = $request->validated();
        $formation = Formation::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'competence' => $data['competence'],
        ]);

        $formation->users()->attach($data['users']);
        foreach ($data['users'] as $user_id) {
            \App\Models\Carriere::create([
                'user_id' => $user_id,
                'formation_id' => $formation->id,
                'promotion' => null, 
                'augmentation' => null, 
            ]);
        }

        return redirect()->route('formations.index')->with('success', 'Formation créée avec succès.');
    }


    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        $data = $request->validated();

        $formation->update([
            'name' => $data['name'],
            'type' => $data['type'],
            'competence' => $data['competence'],
        ]);

        $formation->users()->sync($data['users']);

        \App\Models\Carriere::where('formation_id', $formation->id)->delete();
        foreach ($data['users'] as $user_id) {
            \App\Models\Carriere::create([
                'user_id' => $user_id,
                'formation_id' => $formation->id,
                'promotion' => null, 
                'augmentation' => null, 
            ]);
        }

        return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès.');
    }

    public function destroy(Formation $formation)
    {
        \App\Models\Carriere::where('formation_id', $formation->id)->delete();
        $formation->users()->detach();
        $formation->delete();

        return redirect()->route('formations.index')->with('success', 'Formation supprimée avec succès.');
    }


}
