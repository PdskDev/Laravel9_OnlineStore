@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('storage/'.$viewData['product']->getImage()) }}" class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $viewData['product']->getName() }} (${{ $viewData['product']->getPrice() }})
                </h5>
                <p class="card-text">{{ $viewData['product']->getDescription() }}</p>
                <p class="card-text">
                <form method="POST" action="{{ route('cart.add', ['id' => $viewData['product']->getId() ]) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-auto">
                            <div class="input-group col-auto mb-4">
                                <div class="input-group-text">Quantity</div>
                                <input type="number" main="1" max="10" class="form-control quantity-input" name="quantity" value="1">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-outline-success" type="submit">Add to cart</button>&nbsp;
                                <a href="{{ route('products.index') }}" class="btn btn-outline-warning">Back to product list</a>
                            </div>
                        </div>
                    </div>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection