@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3>Editar produto</h3>
            <div>
                <base-form
                    :fields="[
                        {name: '_method', type_input:'hidden', label:'method', value:'PUT'},
                        {name: 'name', type_input:'text', label:'Nome', value: '{{$product->name}}'},
                        {name: 'value', type_input:'number', label:'Valor', value: '{{$product->value}}'},
                        {name: 'quantity', type_input:'text', label:'Quantidade', value: '{{$product->quantity}}'},
                        {name: 'category_id', type_input:'text', label:'Categoria', value: '{{$product->category_id}}', options: {{$categories}}},
                    ]"
                    actions="products"
                    csrf="{{ csrf_token() }}"
                    route-list="{{route('products.index')}}"
                    route-form="{{ route('products.update', $product->id) }}"
                ></base-form>
            </div>
            </div>
        </div>
    </div>
@endsection
