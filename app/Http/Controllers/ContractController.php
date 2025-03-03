<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use Illuminate\Routing\Controller as BaseController;

class ContractController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:view-contracts')->only(['index', 'show']);
        $this->middleware('permission:create-contracts')->only(['create', 'store']);
        $this->middleware('permission:edit-contracts')->only(['edit', 'update']);
        $this->middleware('permission:delete-contracts')->only('destroy');
    }

    public function index()
    {
        $contracts = Contract::all();
        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        return view('contracts.create');
    }

    public function store(ContractRequest $request)
    {
        Contract::create($request->validated());
        return redirect()->route('contracts.index')->with('success', 'Contrat ajouté avec succès.');
    }

    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        return view('contracts.edit', compact('contract'));
    }

    public function update(ContractRequest $request, Contract $contract)
    {
        $contract->update($request->validated());
        return redirect()->route('contracts.index')->with('success', 'Contrat modifié avec succès.');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index')->with('success', 'Contrat supprimé avec succès.');
    }
}
