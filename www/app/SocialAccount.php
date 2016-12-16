<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'user_id',
        'provider_user_id',
        'provider_access_token',
        'provider',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
