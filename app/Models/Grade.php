<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'level'];

    public function users()
    {
        return $this->hasMany(User::class);  // A grade can be assigned to many users
    }
}
