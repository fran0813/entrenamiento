@if(auth()->user()->hasRole('Admin'))

    @extends('layouts.base')

    @include('admin.section.navbar')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-ls-12 col-sm-12"></div>

            @include('layouts.section.status')
          
        </div>
    </div>
    @endsection

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif