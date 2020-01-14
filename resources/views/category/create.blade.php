@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Nova categoria</h1>
            <div>
                <base-form
                    :fields="[{name: 'name', type_input:'text', label:'Nome', value:''}]"
                    actions="categories"
                    csrf="{{ csrf_token() }}"
                    route-form="{{route('categories.store')}}"
                    route-list="{{ route('categories.index') }}"
                ></base-form>
            </div>
        </div>
    </div>
@endsection

