@if(auth()->user()->hasRole('Admin'))

    @extends('layouts.base')

    @include('admin.section.navbar')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-ls-12 col-sm-12 text-center">
              <a class="btn btn-success" href="#" data-toggle='modal' data-target='#modalCrearCategoria'>Crear categoría</a> 
            </div>
            <div style="margin-top: 1%; margin-bottom: 1%;" class="col-md-12 col-ls-12 col-sm-12"></div>
            <div id="mostrarTablaCategoria" class="col-md-12 col-ls-12 col-sm-12"></div>
        </div>
    </div>
    @endsection

    @section('javascript')
        <script src="{{ asset('js/admin/categoria.js') }}"></script>
    @endsection

    @include('admin.modal.crearCategoria')
    @include('admin.modal.actualizarCategoria')
    @include('admin.modal.eliminarCategoria')

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif