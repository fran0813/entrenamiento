$(document).ready(function()
{
	mostrarTablaUsuariosCalificar();
});

function mostrarTablaUsuariosCalificar()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarTablaUsuariosCalificar",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$('#mostrarTablaUsuariosCalificar').html(response.html);
	});
}

function calificar(response)
{
	var id = response.id;
	var value = response.value;

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/calificar",
		dataType: 'json',
		data: { id: id,
				value: value}
	})

	.done(function(response){
		mostrarTablaUsuariosCalificar();
	});
}