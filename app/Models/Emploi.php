<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Departement;

class Emploi extends Model
{
    use HasFactory;

    protected $fillable = ['name','departement_id'];

    public function departement(){

        return $this->belongsTo(Departement::class);
    }
}
