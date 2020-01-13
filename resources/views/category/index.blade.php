@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Categorias</h3>

    @can('create', App\Category::class)
        <a class="btn btn-small btn-info" href="{{ URL::to('categories/create') }}">Nova Categoria</a><br><br>
    @endcan

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <base-table
        :items="{{$categories}}"
        v-bind:has-permission="true"
        actions="categories"
        csrf="{{ csrf_token() }}"
    ></base-table>
</div>
@endsection
