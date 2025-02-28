<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'competence',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'formation_user');
    }
}
