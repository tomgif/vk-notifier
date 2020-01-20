<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'peer_id', 'user_id', 'is_subscribed', 'description'
    ];
}
