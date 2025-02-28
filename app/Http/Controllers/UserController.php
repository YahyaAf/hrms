<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contract;
use App\Models\Departement;
use App\Models\Emploi;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with(['contract', 'departement', 'emploi', 'grade'])->paginate(10);
        return view('users.index', compact('users'));
    }

   
    public function create()
    {
        $contracts = Contract::all();
        $departements = Departement::all();
        $emplois = Emploi::all();
        $grades = Grade::all();

        return view('users.create', compact('contracts', 'departements', 'emplois', 'grades'));
    }

   
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

   
    public function edit(User $user)
    {
        $contracts = Contract::all();
        $departements = Departement::all();
        $emplois = Emploi::all();
        $grades = Grade::all();

        return view('users.edit', compact('user', 'contracts', 'departements', 'emplois', 'grades'));
    }

   
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function getEmplois($departement_id)
    {
        $emplois = Emploi::where('departement_id', $departement_id)->get();
        return response()->json($emplois);
    }
}
