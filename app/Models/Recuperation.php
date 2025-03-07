<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recuperation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_debut',
        'date_fin',
        'nombre_jours',
        'validation_rh',
        'statut',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

