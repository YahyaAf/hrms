<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'date_de_recrutement',
        'date_naissance',
        'adresse',
        'salaire',
        'statut',
        'contract_id',
        'departement_id',
        'emploi_id',
        'grade_id',
        'solde_recuperation',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_naissance' => 'date',
        ];
    }

    // Définition des relations

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    
    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_user');
    }

}
