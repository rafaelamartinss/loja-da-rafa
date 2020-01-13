@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3>Editar categoria</h3>
            <div>
                <base-form
                    v-bind:fields="[
                        {name: '_method', type_input:'hidden', label:'method', value:'PUT'},
                        {name: 'name', type_input:'text', label:'Nome', value:'{{$category->name}}'},
                    ]"
                    actions="categories"
                    csrf="{{ csrf_token() }}"
                    route-list="{{route('categories.index')}}"
                    route-form="{{ route('categories.update', $category->id) }}"
                ></base-form>
            </div>
        </div>
    </div>
@endsection
