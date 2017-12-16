$(document).ready(function()
{
	mostrarTablaCategoria();
});

$("#formCrearCategoria").on("submit", function()
{
	var name = $("#crearCategoria").val();

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/crearCategoria",
		dataType: 'json',
		data: { name: name }
	})

	.done(function(response){
		mostrarTablaCategoria();
		$('#respuestaCrearCategoria').html(response.html);
	});
	return false;
});

function mostrarTablaCategoria()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarTablaCategoria",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$('#mostrarTablaCategoria').html(response.html);
	});
}

$("#mostrarTablaCategoria").on("click", "a", function(){

	var value = $(this).attr("value");
	var id = $(this).attr("id");

	if (value == "actualizar") {
		$('#idActualizarCategoria').val(id);
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			method: "GET",
			url: "/admin/mostrarActualizarCategoria",
			dataType: 'json',
			data: { id: id }
		})

		.done(function(response) {
			$('#actualizarCategoria').val(response.name);
		});
	} else if (value == "eliminar"){
		$('#idEliminarCategoria').val(id);
	} else if (value == "asignar") {
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			method: "POST",
			url: "/admin/idCategoria",
			dataType: 'json',
			data: { id: id }
		})

		.done(function(response) {
			location.href = '/admin/asignarCategoria';
		});
	} else if (value == "calificar") {
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			method: "POST",
			url: "/admin/idCategoria",
			dataType: 'json',
			data: { id: id }
		})

		.done(function(response) {
			location.href = '/admin/calificarCategoria';
		});
	}
});

$("#formEditarCategoria").on("submit", function()
{
	var id = $("#idActualizarCategoria").val();
	var name = $("#actualizarCategoria").val();

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/actualizarCategoria",
		dataType: 'json',
		data: { id: id,
				name: name }
	})

	.done(function(response){
		mostrarTablaCategoria();
		$('#respuestaActualizarCategoria').html(response.html);
	});
	
	return false;
});

$("#formEliminarCategoria").on("submit", function()
{
	var id = $("#idEliminarCategoria").val();

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/eliminarCategoria",
		dataType: 'json',
		data: { id: id }
	})

	.done(function(response){
		mostrarTablaCategoria();
		$('#repuestaEliminarCategoria').html(response.html);
	});

	return false;
});

$(document).bind('keydown',function(eEvento){
    if(eEvento.which == 27) { 
        var $jQuery = window.parent.$;
        $jQuery('body').find('#modalCrearCategoria').trigger('click');
        $jQuery('body').find('#modalActualizarCategoria').trigger('click');
        $jQuery('body').find('#modalEliminarCategoria').trigger('click');
    }
});