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
                <p class="card-text"><small class="btn btn-outline-success">Add to Cart</small>&nbsp;
                <a href="{{ route('products.index') }}" class="btn btn-outline-warning">Back to product list</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection