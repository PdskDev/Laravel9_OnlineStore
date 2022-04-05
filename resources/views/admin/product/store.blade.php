@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
<div class='card mb-4'>
    <div class='card-header'>
        Add New Products
    </div>
    <div class='card-body'>
        @if ($error->any())
        <ul class="alart alert-danger list-unstyled">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul> 
        @endif

        <form action="{{ route('admin.product.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label for="name" class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row">
                        <label for="price" class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="price" value="{{ old('price') }}" type="number" class="form-control">
                        </div>
                    </div>
                </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">description</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
@endsection