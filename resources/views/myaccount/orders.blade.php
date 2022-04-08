@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    @forelse ($viewData['orders'] as $order)
        <div class="card mb-4">
            <div class="card-header">
                Order # {{ $order->getid() }}
            </div>
            <div class="card-body">
                <b>Date:</b> {{ $order->getCreatedAt() }}</br>
                <b>Total:</b> {{ $order->getTotal() }}</br>
                <table class="table table-bordered table-striped text-center mt-3">
                    <thead>
                        <tr>
                            <th>Item#</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->getItems() as $item)
                        <tr>
                          <td>{{ $item->getProduct()->getId() }}</td>
                          <td>
                              <a class="link-success" href="{{ route('products.show', ['id' => $item->getProduct()->getId() ]) }}" >
                                {{ $item->getProduct()->getName() }}
                              </a>
                          </td>
                          <td>${{ $item->getPrice() }}</td>
                          <td>{{ $item->getQuantity() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Seems to be that you have not purchased anything in our store =(.
        <a type="button" class="btn-close" data-bs-dismiss="alert"></a>
    </div> 
    @endforelse
@endsection