<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function status()
    {
        return $this->belongsTo('App\TicketStatus');
    }

    public function actions()
    {
        return $this->hasMany('App\TicketAction');
    }
}
