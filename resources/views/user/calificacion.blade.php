@if(auth()->user()->hasRole('User'))

    @extends('layouts.base')

    @include('user.section.navbar')

    @section('content')
    <div class="container">
        <div class="row">
            <div id="mostrarTablaCalificacion" class="col-md-12 col-ls-12 col-sm-12"></div>
        </div>
    </div>
    @endsection

    @section('javascript')
        <script src="{{ asset('js/user/calificacion.js') }}"></script>
    @endsection

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif