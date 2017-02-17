<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketAction extends Model
{
    public function ticket()
    {
        $this->hasOne('App\Ticket');
    }
}
