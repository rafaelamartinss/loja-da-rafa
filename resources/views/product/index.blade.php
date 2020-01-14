@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Produtos</h3>

    @can('create', App\Product::class)
        <a class="btn btn-small btn-info" href="{{ URL::to('products/create') }}">Novo Produto</a><br><br>
    @endcan

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    <product-table
        :has-permission="true"
        csrf="{{ csrf_token() }}"
    ></product-table>
</div>
@endsection
