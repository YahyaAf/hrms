<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carriere extends Model
{
    use HasFactory;

    protected $fillable = ['grade_id', 'augmentation', 'user_id', 'formation_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
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
