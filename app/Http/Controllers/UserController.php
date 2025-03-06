<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contract;
use App\Models\Departement;
use App\Models\Emploi;
use App\Models\Grade;
use App\Models\Carriere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:view-users')->only(['index', 'show']);
        $this->middleware('permission:create-users')->only(['create', 'store']);
        $this->middleware('permission:edit-users')->only(['edit', 'update']);
        $this->middleware('permission:delete-users')->only('destroy');
    }

    public function index()
    {
        $users = User::with(['contract', 'departement', 'emploi', 'grade', 'roles'])
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $contracts = Contract::all();
        $departements = Departement::all();
        $emplois = Emploi::all();
        $grades = Grade::all();
        $roles = Role::where('name', '!=', 'admin')->get();  

        return view('users.create', compact('contracts', 'departements', 'emplois', 'grades', 'roles'));
    }


    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if ($request->has('role')) {
            $user->assignRole($request->role);
        }

        $grade = Grade::find($request->grade_id);
        $grade_id = $grade ? $grade->id : 'default';

        $contract = Contract::find($request->contract_id);
        $contract_id = $contract ? $contract->id : 'default'; 

        $carriere = new Carriere();
        $carriere->user_id = $user->id;
        $carriere->grade_id = $grade_id; 
        $carriere->contract_id = $contract_id;
        $carriere->augmentation = $request->salaire;
        $carriere->save();


        $date_recrutement = Carbon::parse($user->date_de_recrutement);
        $annees_travaillees = $date_recrutement->diffInYears(Carbon::now());

        if ($annees_travaillees < 1) {
            $mois_travailles = $date_recrutement->diffInMonths(Carbon::now());
            $solde_conges = $mois_travailles * 1.5;
        } else {
            $solde_conges = 18 + (($annees_travaillees - 1) * 0.5);
            // $solde_conges += ($annees_travaillees - 1) * 18;
        }

        $user->solde_conges = round($solde_conges, 1); 
        $user->save();

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
        $roles = Role::all();
        $userRole = $user->roles->pluck('name')->first();

        return view('users.edit', compact('user', 'contracts', 'departements', 'emplois', 'grades', 'roles', 'userRole'));
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

        if ($request->has('role')) {
            $user->syncRoles([$request->role]);
        }

        $carriere = Carriere::where('user_id', $user->id)->first();
        if ($carriere) {
            $grade = Grade::find($request->grade_id);
            $grade_id = $grade ? $grade->id : 'default';

            $contract = Contract::find($request->contract_id);
            $contract_id = $contract ? $contract->id : 'default'; 

            $carriere->grade_id = $grade_id; 
            $carriere->augmentation = $request->salaire; 
            $carriere->contract_id = $contract_id;
            $carriere->save();
        }

        $date_recrutement = Carbon::parse($user->date_de_recrutement);
        $annees_travaillees = $date_recrutement->diffInYears(Carbon::now());

        $solde_conges = 18 + (($annees_travaillees - 1) * 0.5); 
        // $solde_conges += $annees_travaillees * 18;  

        $user->solde_conges = round($solde_conges, 1); 
        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }


    public function destroy(User $user)
    {
        $carriere = Carriere::where('user_id', $user->id)->first();
        if ($carriere) {
            $carriere->delete();
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function getEmplois($departement_id)
    {
        $emplois = Emploi::where('departement_id', $departement_id)->get();
        return response()->json($emplois);
    }
}
