@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ( $orders as $order )
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order #{{ $order->id }}</h4>
                            <p class="mb-1"><strong>Address</strong>: {{ $order->address }}</p>
                            <p><strong>Phone</strong>: {{ $order->phone }}</p>
                            <a href="{{ url('orders/show', $order->id) }}">Click here for more details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection