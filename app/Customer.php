<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function tickets()
    {
        $this->hasMany('App\Ticket');
    }
}
