<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The subscription_pack that belong to the Subscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscription_pack()
    {
        return $this->belongsTo(SubscriptionPack::class);
    }

}
