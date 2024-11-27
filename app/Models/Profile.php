<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($profile) {
            $profile->avatar()->create();
            $profile->update(['avatar_id' => $profile->avatar->id]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }
}
