@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tickets</h3>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="/tickets/store">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-4 form-col-left">
                            <div class="form-group">
                                <label for="">Ticket toevoegen als</label>
                                @if(Auth::user()->role == 1)
                                    <select class="selectpicker" disabled>
                                        @foreach(App\User::all() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                @else()
                                    <label for=""></label>
                                    <input type="text" value="{{$user->name}}" disabled>
                                @endif()
                            </div>

                            <div class="form-group">
                                <label for="ticket-date">Ticket datum</label>
                                <div class="input-append date" id="ticket-date" data-date="{{Carbon\Carbon::now()->format('d-m-Y')}}" data-date-format="dd-mm-yyyy">
                                    <input class="datepicker" name="date" size="29" type="text" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ticket-customer">Klant</label>
                                <select id="ticket-customer" name="customer" class="selectpicker">
                                    @foreach(App\Customer::all() as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="ticket-description">Probleemomschrijving</label>
                                <textarea class="form-control" name="description" id="ticket-description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Datum</td>
                        <td>Klant</td>
                        <td class="status">Status</td>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr class="ticket" data-id="{{$ticket->id}}">
                                <td>{{$ticket->date}}</td>
                                <td>{{$ticket->customer->name}}</td>
                                <td class="status">{{$ticket->status->status}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Geen tickets.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.ticket').on('click', function() {
            window.location.href = 'tickets/'+$(this).data('id');
        });
    </script>
@endsection