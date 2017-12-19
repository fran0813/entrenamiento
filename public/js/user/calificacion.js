$(document).ready(function()
{
	mostrarTablaCalificacion();
});

function mostrarTablaCalificacion()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/user/mostrarTablaCalificacion",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$('#mostrarTablaCalificacion').html(response.html);
	});
}