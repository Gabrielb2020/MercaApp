@extends('layouts.app')

@section('content')
    <h1>Tu carrito</h1>
    
    @if(!isset($cart) || $cart->products->isEmpty())
        <div class="alert alert-warning">
            El carrito esta vacio
        </div>
    @else
        <h4 class="text-center">Total de su carrito <strong> {{ $cart->total }} </strong></h4>
        <a class="btn btn-success mb-3" href="{{ route('orders.create') }}">
            Orden de inicio
        </a>
        <div class="row">
            @foreach ($cart->products as $product)
                <div class="col-3">
                    @include('components.productCard')
                </div>
            @endforeach
        </div>
    @endempty
@endsection