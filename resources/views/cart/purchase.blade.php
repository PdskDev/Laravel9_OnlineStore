@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
<div class="card">
    <div class="card-header">Purchase completed</div>
    <div class="card-body">
        <div class="alert alert-sucess text-center" role="role">
            Congratulations, purchase completed. Order number is <b>#{{ $viewData['order']->getId() }}</b>
        </div>
    </div>
</div>    
@endsection