$(document).on("click", ".kilogramos", function(){
	document.getElementById('label-peso').innerHTML = "Kilogramos";
	$("#input-peso").val('kg');
})
$(document).on("click", ".gramos", function(){
	document.getElementById('label-peso').innerHTML = "Gramos";
	$("#input-peso").val('g');
})
$(document).on("click", ".litros", function(){
	document.getElementById('label-peso').innerHTML = "Litros";
	$("#input-peso").val('l');
})
$(document).on("click", ".mililitros", function(){
	document.getElementById('label-peso').innerHTML = "Mililitros";
	$("#input-peso").val('ml');
})

//update peso

$(document).on("click", ".kilogramos-update", function(){
	document.getElementById('label-peso-update').innerHTML = "Kilogramos";
	$("#input-peso-update").val('kg');
})
$(document).on("click", ".gramos-update", function(){
	document.getElementById('label-peso-update').innerHTML = "Gramos";
	$("#input-peso-update").val('g');
})
$(document).on("click", ".litros-update", function(){
	document.getElementById('label-peso-update').innerHTML = "Litros";
	$("#input-peso-update").val('l');
})
$(document).on("click", ".mililitros-update", function(){
	document.getElementById('label-peso-update').innerHTML = "Mililitros";
	$("#input-peso-update").val('ml');
})
if ($("#input-peso-update").val()=="kg") {
	document.getElementById('label-peso-update').innerHTML = "Kilogramos";
	console.log("accion", "funciono");
}
if ($("#input-peso-update").val()=="ml") {
	document.getElementById('label-peso-update').innerHTML = "Mililitros";
}
if ($("#input-peso-update").val()=="l") {
	document.getElementById('label-peso-update').innerHTML = "Litros";
}
if ($("#input-peso-update").val()=="g") {
	document.getElementById('label-peso-update').innerHTML = "Gramos";
}
$(document).on("change", ".fecha_vencimiento", function(){
	var fechaElab = $('#fecha_elaboracion').val();
	var fechaVen = $('#fecha_vencimiento').val();
	if (fechaVen<=fechaElab) {
		$("#fecha_vencimiento").val('');
	}
})
$(document).on("change", ".fecha_vencimiento_update", function(){
	var fechaElab = $('#fecha_elaboracion_update').val();
	var fechaVen = $('#fecha_vencimiento_update').val();
	if (fechaVen<=fechaElab) {
		$("#fecha_vencimiento_update").val('');
	}
})
/*=============================================
DataTable Servidor de artículos
=============================================*/

// $.ajax({

// 	url: ruta+"/articulos",
// 	success: function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	},
// 	error: function (jqXHR, textStatus, errorThrown) {
//         console.error(textStatus + " " + errorThrown);
//     }

// })

/*=============================================
DataTable de artículos
=============================================*/

var tablaProductos = $("#tablaProductos").DataTable({
	
	processing: true,
  	serverSide: true,

  	ajax:{
  		url: ruta+"/productos"		
  	},

  	"columnDefs":[{
  		"searchable": true,
  		"orderable": true,
  		"targets": 0
  	}],

  	"order":[[0, "desc"]],

  	 columns: [{
	    data: 'id_producto',
	    name: 'id_producto'

	  }, 
	  {
	    data: 'nombre_distribuidor',
	    name: 'nombre_distribuidor'

	  },
	  {
	    data: 'serial_entrega',
	    name: 'serial_entrega'

	  }, 
	  {
	    data: 'nombre_producto',
	    name: 'nombre_producto'

	  }, 
	  {
	    data: 'descripcion_producto',
	    name: 'descripcion_producto'

	  }, 
	  {
	    data: 'tipo_producto',
	    name: 'tipo_producto'

	  }, 
	  {
	    data: 'peso_producto',
	    name: 'peso_producto'

	  }, 
	  {
	    data: 'valor_producto',
	    name: 'valor_producto'

	  }, 
	  {
	    data: 'serial_producto',
	    name: 'serial_producto'

	  },
	  {
	    data: 'cantidad_producto',
	    name: 'cantidad_producto'

	  },
	  {
	    data: 'fecha_elaboracion',
	    name: 'fecha_elaboracion'

	  },
	  {
	    data: 'fecha_vencimiento',
	    name: 'fecha_vencimiento'

	  },
	  {
	    data: 'acciones',
	    name: 'acciones'

   	  }

	],
 	"language": {

	    "sProcessing": "Procesando...",
	    "sLengthMenu": "Mostrar _MENU_ registros",
	    "sZeroRecords": "No se encontraron resultados",
	    "sEmptyTable": "Ningún dato disponible en esta tabla",
	    "sInfo": "Mostrando registros del _START_ al _END_",
	    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix": "",
	    "sSearch": "Buscar:",
	    "sUrl": "",
	    "sInfoThousands": ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst": "Primero",
	      "sLast": "Último",
	      "sNext": "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
	      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

  	}

});

tablaProductos.on('order.dt search.dt', function(){

	tablaProductos.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i){ cell.innerHTML = i+1})


}).draw();