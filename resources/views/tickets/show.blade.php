@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Ticket {{$ticket->id}}</h3>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="/tickets/{{$ticket->id}}/update">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-4 form-col-left">
                            <div class="form-group">
                                <label for="">Ticket toegevoegd als</label>
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
                                        <option value="{{$customer->id}}" {{$customer->id == $ticket->customer_id ? 'selected' : ''}}>{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="ticket-description">Probleemomschrijving</label>
                                <textarea class="form-control" name="description" id="ticket-description" cols="30" rows="10">{{$ticket->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="form-control" value="Opslaan">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>

        <div class="row add-action">
            <div class="col-md-offset-1 col-md-10">
                <h4>Werkzaamheden</h4>
                <form action="">
                    <div class="row">
                        <div class="col-md-10">
                            <textarea class="form-control" name="description" id="action-description" cols="30" rows="4"></textarea>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group clockpicker">
                                <input id="action-start_time" type="text" class="form-control" value="{{date('H:m', time())}}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            <hr class="time-hr">
                            <div class="input-group clockpicker">
                                <input id="action-end_time" type="text" class="form-control" value="{{date('H:m', time())}}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn add-action-button" type="button">+</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="ticket-actions">
                    @foreach($ticket->actions as $action)
                        @include('parts.action', $action)
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.ticket').on('click', function() {
            window.location.href = 'tickets/'+$(this).data('id');
        });

        $('.add-action-button').on('click', function() {
            $.ajax({
                url: "/tickets/{{$ticket->id}}/new-action",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    description: $('#action-description').val(),
                    start_time: $('#action-start_time').val(),
                    end_time: $('#action-end_time').val()
                },
                success: function(data){
                    $('.ticket-actions').append(data);
                }
            });
        });
    </script>
@endsection