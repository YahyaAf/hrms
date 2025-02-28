<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Departement;
use App\Models\Emploi;

class DepartementEmploiSelect extends Component
{
    public $departement_id = null;
    public $emplois = [];

    public function updatedDepartementId($value)
    {
        $this->emplois = Emploi::where('departement_id', $value)->get();
    }

    public function render()
    {
        return view('livewire.departement-emploi-select', [
            'departements' => Departement::all(),
            'emplois' => $this->emplois, 
        ]);
    }
}
