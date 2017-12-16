$(document).ready(function()
{
	mostrarTablaUsuarios();
});

function mostrarTablaUsuarios()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarTablaUsuarios",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$('#mostrarTablaUsuarios').html(response.html);
	});
}

$("#mostrarTablaUsuarios").on("click", "a", function(){

	var value = $(this).attr("value");
	var id = $(this).attr("id");

	if (value == "asignar") {
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			method: "POST",
			url: "/admin/asignarUsuario",
			dataType: 'json',
			data: { id: id }
		})

		.done(function(response) {
			mostrarTablaUsuarios();
			$('#respuestaUsuario').html(response.html);
		});
	} else if (value == "desasignar"){
		$('#idDesasignarCategoria').val(id);
	}
});

$("#formDesasignarCategoria").on("submit", function()
{
	var id = $("#idDesasignarCategoria").val();

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/desasignarUsuario",
		dataType: 'json',
		data: { id: id }
	})

	.done(function(response) {
		mostrarTablaUsuarios();
		$('#respuestaUsuario').html(response.html);
	});

	return false;
});

$(document).bind('keydown',function(eEvento){
    if(eEvento.which == 27) { 
        var $jQuery = window.parent.$;
        $jQuery('body').find('#modalDesasignarCategoria').trigger('click');
    }
});
