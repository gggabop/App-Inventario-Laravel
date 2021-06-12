/*=============================================
Probar la conexión con DataTable de Opiniones
=============================================*/

// $.ajax({

//   url: ruta + "/entregas",
//   success: function(respuesta) {

//     console.log("respuesta", respuesta);

//   },
//   error: function (jqXHR, textStatus, errorThrown) {
//       console.error(textStatus + " " + errorThrown);
//   }

// })

/*=============================================
DataTable de Opiniones
=============================================*/

var tablaEntregas = $("#tablaEntregas").DataTable({

  processing: true,
  serverSide: true,

  ajax: {
    url: ruta + "/entregas"
  },

  "columnDefs": [{
            "searchable": true,
            "orderable": true,
            "targets": 0
        }],
  "order": [[ 0, 'asc' ]],
  columns: [{
    data: 'id_entrega',
    name: 'id_entrega'

  }, {
    data: 'nombre_distribuidor',
    name: 'nombre_distribuidor'

  }, {
    data: 'productos_entrega',
    name: 'productos_entrega'

  }, {
    data: 'serial_entrega',
    name: 'serial_entrega'

  }, {
    data: 'fecha_entrega',
    name: 'fecha_entrega'

  }, {
    data: 'acciones',
    name: 'acciones'

  }],
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
})

tablaEntregas.on( 'order.dt search.dt', function () {
    tablaEntregas.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();
