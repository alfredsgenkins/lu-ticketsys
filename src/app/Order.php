<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function tickets() {
        return $this->hasMany('App\TicketOrder');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
