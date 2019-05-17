@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Selected tickets</h4>
                        <div class="card-text">
                            <table class="table table-hover">
                                <thead><tr class="table-primary">
                                    <th scope="col">Event</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Row</th>
                                    <th scope="col">Seat</th>
                                    <th scope="col">Price</th>
                                </tr></thead>
                                <tbody>
                                @foreach ( $tickets as $ticket )
                                    <tr>
                                        <td>{{ $ticket->event->name }}</td>
                                        <td>{{ $ticket->event->formatTime() }}</td>
                                        <td>{{ $ticket->event->location }}</td>
                                        <td>{{ $ticket->row }}</td>
                                        <td>{{ $ticket->seat }}</td>
                                        <td>{{ $ticket->price }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-primary">
                                    <td colspan="5"></td>
                                    <td>{{ $total }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <form action="{{ action('OrderController@placeOrder') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="address">Shipping address</label>
                                    <input class="form-control" type="text" name="address" id="address" required placeholder="Please enter shipping address">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone number</label>
                                    <input class="form-control" type="number" name="phone" id="phone" required placeholder="Please enter phone number">
                                </div>
                                <button type="submit" class="btn btn-primary">Place order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection