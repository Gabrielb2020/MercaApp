@extends('layouts.app')

@section('content')
    <h1>Bienvenido</h1>
   
    @empty($products)
        <div class="alert alert-danger">
            No products yet!
        </div>
    @else
    
        <div class="row">
            @foreach ($products as $product)
                <div class="col-3">
                    @include('components.productCard')
                    
                </div>
            @endforeach
        </div>
    @endempty
@endsection