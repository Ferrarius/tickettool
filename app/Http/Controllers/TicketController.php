<?php

namespace App\Http\Controllers;
use App\Ticket;
use DateTime;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::orderBy('date', 'ASC')->with('customer')->get();

        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('actions')->find($id);

        return view('tickets.show', compact('ticket'));
    }

    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->customer_id = $request->customer;
        $ticket->status_id = 1;
        $ticket->description = $request->description;
        $ticket->date = date("Y-m-d", strtotime($request->date));
        $ticket->save();

        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->customer_id = $request->customer;
        $ticket->status_id = 1;
        $ticket->description = $request->description;
        $ticket->date = date("Y-m-d", strtotime($request->date));
        $ticket->save();

        return redirect('/tickets/'.$id);
    }
}
