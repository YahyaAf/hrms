<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Conge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Illuminate\Routing\Controller as BaseController;

class CongeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('can:view-conge')->only(['index', 'show', 'soldeConges']);
        $this->middleware('can:create-conge')->only(['create', 'store']);
        $this->middleware('can:gestion-conge')->only(['gestionConges']);
        $this->middleware('can:manager-validate-conge')->only(['validateManager']);
        $this->middleware('can:manager-reject-conge')->only(['rejectManager']);
        $this->middleware('can:rh-validate-conge')->only(['validateRh']);
        $this->middleware('can:rh-reject-conge')->only(['rejectRh']);
    }

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

        $start = Carbon::parse($request->date_debut);
        $end = Carbon::parse($request->date_fin);

        $jours_demandes = 0;
        $period = CarbonPeriod::create($start, $end);

        foreach ($period as $date) {
            if (!$date->isWeekend()) { 
                $jours_demandes++;
            }
        }


        $validation_manager = auth()->user()->hasRole('manager') ? true : false;

        Conge::create([
            'user_id' => auth()->id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'jours_demandes' => $jours_demandes, 
            'type_conge' => $request->type_conge,
            'motif' => $request->motif,
            'statut' => 'En attente',
            'validation_manager' => $validation_manager, 
            'validation_rh' => false, 
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
        $conges = Conge::with(['user'])
            ->where('statut', 'En attente') 
            ->get();

        return view('conges.conge', compact('conges'));
    }


    public function validateManager($id)
    {
        $conge = Conge::findOrFail($id);
        $user = auth()->user(); 

        if ($user->hasRole('manager') && !$conge->validation_manager) {
            if ($user->departement_id == $conge->user->departement_id) {
                $conge->validation_manager = true;
                $conge->save();
                
                if ($conge->validation_manager && $conge->validation_rh) {
                    $this->approuverConge($conge);
                }

                return redirect()->route('conges.gestion')->with('success', 'Validation Manager mise à jour avec succès.');
            } else {
                return redirect()->route('conges.gestion')->with('error', 'Vous ne pouvez pas valider cette demande, l\'employé n\'est pas dans votre département.');
            }
        }

        return redirect()->route('conges.gestion')->with('error', 'Accès non autorisé.');
    }


    public function validateRh($id)
    {
        $conge = Conge::findOrFail($id);
        $user = auth()->user(); 

        if ($user->hasRole('RH') && !$conge->validation_rh) {
            if ($user->departement_id == $conge->user->departement_id) {
                $conge->validation_rh = true;
                $conge->save();

                if ($conge->validation_manager && $conge->validation_rh) {
                    $this->approuverConge($conge);
                }

                return redirect()->route('conges.gestion')->with('success', 'Validation RH mise à jour avec succès.');
            } else {
                return redirect()->route('conges.gestion')->with('error', 'Vous ne pouvez pas valider cette demande, l\'employé n\'est pas dans votre département.');
            }
        }

        return redirect()->route('conges.gestion')->with('error', 'Accès non autorisé.');
    }

    private function approuverConge($conge)
    {
        $user = $conge->user;

        if ($user->solde_conges >= $conge->jours_demandes) {
            $user->solde_conges -= $conge->jours_demandes; 
            $user->save();

            $conge->statut = 'Approuvé';
            $conge->save();
        } else {
            $conge->statut = 'Rejeté';
            $conge->save();

            return redirect()->route('conges.gestion')->with('error', 'Solde de congés insuffisant, demande rejetée.');
        }
    }





    public function rejectManager($id)
    {
        $conge = Conge::findOrFail($id);

        if (auth()->user()->hasRole('manager')) {
            $conge->validation_manager = false;
            $conge->statut = 'Rejeté';
            $conge->save();
        }

        return redirect()->route('conges.gestion')->with('success', 'Demande de congé rejetée par le manager.');
    }

    public function rejectRh($id)
    {
        $conge = Conge::findOrFail($id);

        if (auth()->user()->hasRole('RH')) {
            $conge->validation_rh = false;
            $conge->statut = 'Rejeté';
            $conge->save();
        }

        return redirect()->route('conges.gestion')->with('success', 'Demande de congé rejetée par RH.');
    }

}
