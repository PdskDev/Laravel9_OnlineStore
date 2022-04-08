@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
<div class="row">
    @if ($message = Session::get('successDelete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <a type="button" class="btn-close" data-bs-dismiss="alert"></a>
            </div>
            @endif
    @foreach ($viewData['products'] as $product)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            <img src="{{ asset('storage/'.$product->getImage()) }}" class="card-img-top img-card">
            <div class="card-body text-center">
                <a href="{{ route('products.show', ['id'=>$product->getId()]) }}" class="btn btn-outline-success">
                {{ $product->getName() }}
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection