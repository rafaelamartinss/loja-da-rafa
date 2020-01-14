@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3>Novo produto</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif

            <div>
                <base-form
                    :fields="[
                        {name: 'name', type_input:'text', label:'Nome'},
                        {name: 'value', type_input:'number', label:'Valor'},
                        {name: 'quantity', type_input:'text', label:'Quantidade'},
                        {name: 'category_id', type_input:'text', label:'Categoria', options: {{$categories}}},
                    ]"
                    actions="products"
                    csrf="{{ csrf_token() }}"
                    route-list="{{route('products.index')}}"
                    route-form="{{ route('products.store') }}"
                ></base-form>
            </div>
        </div>
    </div>
@endsection
