<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Emploi;

class Departement extends Model
{
    use HasFactory;
    protected $fillable = ['nom','description'];

    public function emplois()
    {
        return $this->hasMany(Emploi::class);
    }

    public function users()
    {
        return $this->hasMany(User::class); 
    }
}
