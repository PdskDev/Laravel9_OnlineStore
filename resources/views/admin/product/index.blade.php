@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
    <div class='card mb-4'>
        <div class='card-header'>
            Add New Products
        </div>
        <div class='card-body'>
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</a>
            </div>
            @endif

            @if ($message = Session::get('successAdd'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
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
                            <label for="price" class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="price" value="{{ old('price') }}" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add New</button>
            </form>
        </div>
    </div>
    <div class='card'>
        <div class='card-header'>
            Catalog of products
        </div>
        <div class='card-body'>
            <form action="#" method="post">
                <div class="d-flex justify-content-end mb-3">
                    <a href="" class="btn btn-success">Edit</a>&nbsp;<a href="" class="btn btn-danger">Delete</a>
                </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Select</th>
                        <!--<th scope="col"></th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData['products'] as $product)
                        <tr>
                            <th scope="row">{{ $product->getId() }}</th>
                            <td>{{ $product->getName() }}</td>
                            <td>{{ $product->getDescription() }}</td>
                            <td>{{ $product->getPrice() }}</td>
                            <td>
                            <input type="checkbox" name="id" value="{{ $product->getId() }}">
                            </td>
                            <!--<td>
                                <a href="" class="btn btn-success">Edit</a> 
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>-->
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </form>
        </div>
    </div>
@endsection
