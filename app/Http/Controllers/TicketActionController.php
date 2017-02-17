<?php

namespace App\Http\Controllers;
use App\TicketAction;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class TicketActionController extends Controller
{
    public function store(Request $request, $id)
    {
        $action = new TicketAction;
        $action->description = $request->description;
        $action->start_time = $request->start_time;
        $action->end_time = $request->end_time;
        $action->ticket_id = $id;
        $action->save();

        return View::make('parts.action', ['action' => $action])->render();
    }
}
