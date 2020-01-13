@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Nova categoria</h1>
            <div>
                <app-form
                    v-bind:fields="[{name: 'name', type:'text', label:'Nome', value:''}]"
                    actions="categories"
                    csrf="{{ csrf_token() }}"
                    route-form="{{route('categories.store')}}"
                    route-list="{{ route('categories.index') }}"
                ></app-form>
            </div>
        </div>
    </div>
@endsection

