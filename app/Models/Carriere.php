<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carriere extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'promotion', 
        'augmentation', 
        'formation_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($carriere) {
            $user = $carriere->user;
            if ($user) {
                if ($carriere->isDirty('promotion')) {
                    $user->update(['promotion' => $carriere->promotion]);
                }
                if ($carriere->isDirty('augmentation')) {
                    $user->update(['augmentation' => $carriere->augmentation]);
                }
            }
        });
    }
}
