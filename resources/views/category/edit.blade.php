@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3>Editar categoria</h3>
            <div>
                <app-form
                    v-bind:fields="[
                        {name: '_method', type:'hidden', label:'method', value:'PUT'},
                        {name: 'name', type:'text', label:'Nome', value:'{{$category->name}}'},
                    ]"
                    actions="categories"
                    csrf="{{ csrf_token() }}"
                    route-list="{{route('categories.index')}}"
                    route-form="{{ route('categories.update', $category->id) }}"
                ></app-form>
            </div>
        </div>
    </div>
@endsection
