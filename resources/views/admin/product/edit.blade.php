@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
<div class='card mb-4'>
    <div class='card-header'>
        Edit Product
    </div>
    <div class='card-body'>
        @if ($errors->any())
        <ul class="alart alert-danger list-unstyled">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul> 
        @endif

        <form method="POST" action="{{ route('admin.product.update', ['id'=>$viewData['product']->getId()]) }}" 
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label for="name" class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="name" value="{{ $viewData['product']->getName() }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row">
                        <label for="price" class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="price" value="{{ $viewData['product']->getPrice() }}" type="number" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="image" class="form-label">Image:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input class="form-control" type="file" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        &nbsp;
                    </div>
                </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">description</label>
                            <textarea name="description" class="form-control">{{ $viewData['product']->getDescription() }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Now</button>
                </form>
            </div>
        </div>
@endsection