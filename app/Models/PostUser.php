<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
    use HasFactory;

    protected $table = 'post_user';

    public function post()
    {
        return $this->belongsTo(Post::class );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
