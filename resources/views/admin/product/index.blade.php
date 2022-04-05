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
                <a type="button" class="btn-close" data-bs-dismiss="alert">&times;</a>
            </div>
            @endif

            @if ($message = Session::get('successAdd'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <a type="button" class="btn-close" data-bs-dismiss="alert">&times;</a>
            </div>
            @endif

            @if ($message = Session::get('successUpdate'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <a type="button" class="btn-close" data-bs-dismiss="alert">&times;</a>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="name" class="form-label">Name:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" value="{{ old('name') }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="price" class="form-label">Price:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="price" value="{{ old('price') }}" type="number" class="form-control">
                            </div>
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
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary bi bi-bag-plus-fill"> Add new product</button>
            </form>
        </div>
    </div>
    <div class='card'>
        <div class='card-header'>
            Catalog of products
        </div>
        <div class='card-body'>
            @if ($message = Session::get('successDelete'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <a type="button" class="btn-close" data-bs-dismiss="alert">&times;</a>
            </div>
            @endif
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <!--<th scope="col">Picture</th>-->
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData['products'] as $product)
                        <tr>
                            <th scope="row">{{ $product->getId() }}</th>
                            <!--<td><img src="{{ asset('/storage/'.$product->getImage()) }}" width="8%" height="8%"></td>-->
                            <td>{{ $product->getName() }}</td>
                            <td>{{ $product->getDescription() }}</td>
                            <td>{{ $product->getPrice() }}</td>
                            <td>
                            <a href="{{ route('admin.product.edit', ['id'=>$product->getId()]) }}" class="btn btn-success bi-pencil"></a>
                            </td>
                            <td>
                            <a href="#" class="btn btn-danger bi-trash" onclick="if(confirm('Êtes-vous sûr(e) de supprimer cet enregistrement ?')){ document.getElementById('product-{{ $product->getId() }}').submit();}"></a>
                            <form id="product-{{ $product->getId() }}" action="{{ route('admin.product.delete', $product->getId()) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
