<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    protected $fillable = [
        'user_id',
        'date_debut',
        'date_fin',
        'jours_demandes',
        'type_conge',
        'motif',
        'statut',
    ];
}
