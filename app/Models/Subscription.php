<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable =
    [
        'user_id',
        'plan_id',
        'mp_subscription_id',
        'mp_preference_id',
        'status',
        'start_date',
        'end_date',
        'next_payment',
    ];
}
