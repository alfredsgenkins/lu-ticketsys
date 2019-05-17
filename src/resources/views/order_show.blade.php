@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order #{{ $order->id }}</h4>
                        <p class="mb-1"><strong>Address</strong>: {{ $order->address }}</p>
                        <p><strong>Phone</strong>: {{ $order->phone }}</p>
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
                                @foreach ( $order->tickets as $ticket )
                                    <tr>
                                        <td>{{ $ticket->ticket->event->name }}</td>
                                        <td>{{ $ticket->ticket->event->formatTime() }}</td>
                                        <td>{{ $ticket->ticket->event->location }}</td>
                                        <td>{{ $ticket->ticket->row }}</td>
                                        <td>{{ $ticket->ticket->seat }}</td>
                                        <td>{{ $ticket->ticket->price }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection