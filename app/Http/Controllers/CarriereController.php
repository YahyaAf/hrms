<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Carriere;
use App\Models\Contract;
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

    public function create($user_id = null)
    {
        $users = User::all();
        $grades = Grade::all();
        $contracts = Contract::all();
        $carriere = null;

        if ($user_id) {
            $user = User::findOrFail($user_id);
        }

        return view('carrieres.create', compact('users', 'grades', 'carriere', 'user','contracts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grade_id' => 'required|exists:grades,id',
            'augmentation' => 'required|numeric|min:0',
            'contract_id' => 'nullable|exists:contracts,id',
        ]);

        $carriere = Carriere::create([
            'user_id' => $request->user_id,
            'grade_id' => $request->grade_id,
            'augmentation' => $request->augmentation,
            'contract_id' => $request->contract_id,
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update([
            'grade_id' => $request->grade_id,
            'salaire' => $request->augmentation,
            'contract_id' => $request->contract_id,
        ]);

        return redirect()->route('carrieres.show', $carriere->user_id)->with('success', 'Carrière ajoutée avec succès.');
    }


    public function show($user_id)
    {
        $carrieres = Carriere::where('user_id', $user_id)->get();
        return view('carrieres.show', compact('carrieres', 'user_id'));
    }

    public function edit($id)
    {
        $carriere = Carriere::findOrFail($id);
        $grades = Grade::all();
        $contracts = Contract::all();

        return view('carrieres.edit', compact('carriere', 'grades','contracts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'augmentation' => 'required|numeric|min:0',
            'contract_id' => 'required|numeric|min:0'
        ]);

        $carriere = Carriere::findOrFail($id);
        $carriere->update([
            'grade_id' => $request->grade_id,
            'augmentation' => $request->augmentation,
            'contract_id' => $request->contract_id,
        ]);

        return redirect()->route('carrieres.show', $carriere->id)->with('success', 'Carrière mise à jour avec succès.');
    }
}
