/*=============================================
Probar la conexión con DataTable de Anuncios
=============================================*/

// $.ajax({

//   url: ruta + "/anuncios",
//   success: function(respuesta) {

//     console.log("respuesta", respuesta);

//   },
//   error: function (jqXHR, textStatus, errorThrown) {
//       console.error(textStatus + " " + errorThrown);
//   }

// })
$(document).on("change", ".idProd", function(){
  $.ajax({

    url: ruta + "/salidas/all",
    method: 'POST', 
    data:{
      id:1,
      _token:$('input[name="_token"]').val()
    }
  }).done(function(res){
    var arreglo = JSON.parse(res);
    for (var i=0; i<arreglo.length; i++) {
      var idProducto = $("#id_prod").val();
      if (idProducto == arreglo[i].id_producto) {
        var cantidadActualizar = arreglo[i].cantidad_producto;
        console.log("cantidad2", cantidadActualizar);
        $(document).on("change", ".cantidad_salida", function(){
          document.getElementById('alerta').innerHTML="";
          var cantidadRestar = $("#cantidad_salida").val();
          if (cantidadRestar<=cantidadActualizar) {
            var cantidadRes = cantidadActualizar-cantidadRestar;
            $("#cantidadProducto").val(cantidadRes);
            console.log("cantidad", cantidadRes);
            document.getElementById('botonGuardar').style.display = 'inline';
          }else{
            document.getElementById('alerta').innerHTML = '<div class="alert alert-warning"><p>No existen tantos productos</p></div>';
            $("#cantidadProducto").val('');
            $("#cantidad_salida").val('');
            document.getElementById('botonGuardar').style.display = 'none';
          }
        })
      }
    }
  });
});
window.onload = function(){
  $.ajax({

    url: ruta + "/salidas/all",
    method: 'POST', 
    data:{
      id:1,
      _token:$('input[name="_token"]').val()
    }
  }).done(function(res){
    var arreglo = JSON.parse(res);
        for (var i=0; i<arreglo.length; i++) {

      var idProducto = $("#id_prod2").val();

      if (idProducto == arreglo[i].id_producto) {

        var cantidadActualizar = arreglo[i].cantidad_producto;

        console.log("cantidadTEST", cantidadActualizar);

          document.getElementById('alerta').innerHTML="";

            $("#cantidadProducto2").val(cantidadActualizar);

            console.log("cantidadTEST2", cantidadActualizar);

      }
    }
  });
};
$(document).ready(function(){
  function salidas(){
  $.ajax({

    url: ruta + "/salidas/all",
    method: 'POST', 
    data:{
      id:1,
      _token:$('input[name="_token"]').val()
    }
  }).done(function(res){

    var arreglo = JSON.parse(res);

    for (var i=0; i<arreglo.length; i++) {

      var idProducto = $("#id_prod2").val();

      if (idProducto == arreglo[i].id_producto) {

        var cantidadActualizar = arreglo[i].cantidad_producto;

        console.log("cantidad2", cantidadActualizar);

        $("#cantidad_salida2").change(function(){

          document.getElementById('alerta').innerHTML="";

          var cantidadRes = 0;

          var hiddenSalida = 0;

          var cantidadRestar = $("#cantidad_salida2").val();

          var hiddenSalida = $("#hiddenCantidadSalida").val();

          if (cantidadRestar<=cantidadActualizar) {

            var cantidadRes = cantidadActualizar-cantidadRestar;

            var hiddenSalida= Number(cantidadRestar)+Number(hiddenSalida);

            $("#cantidadProducto2").val(cantidadRes);

            $("#hiddenCantidadSalida2").val(hiddenSalida);

            console.log("cantidad", cantidadRes);
            console.log("cantidadSal", hiddenSalida);

            document.getElementById('botonGuardar2').style.display = 'inline';

          }else{
            document.getElementById('alerta2').innerHTML = '<div class="alert alert-warning"><p>No existen tantos productos</p></div>';

            $("#cantidadProducto2").val('');

            $("#cantidad_salida2").val('');

            document.getElementById('botonGuardar2').style.display = 'none';

          }

        })

        $("#cantidad_salida2").keyup(function(){

          document.getElementById('alerta').innerHTML="";

          var cantidadRes = 0;

          var hiddenSalida = 0;

          var cantidadRestar = $("#cantidad_salida2").val();

          var hiddenSalida = $("#hiddenCantidadSalida").val();

          if (cantidadRestar<=cantidadActualizar) {

            var cantidadRes = cantidadActualizar-cantidadRestar;

            var hiddenSalida= Number(cantidadRestar)+Number(hiddenSalida);

            $("#cantidadProducto2").val(cantidadRes);

            $("#hiddenCantidadSalida2").val(hiddenSalida);

            console.log("cantidad", cantidadRes);
            console.log("cantidadSal", hiddenSalida);

            document.getElementById('botonGuardar2').style.display = 'inline';

          }else{
            document.getElementById('alerta2').innerHTML = '<div class="alert alert-warning"><p>No existen tantos productos</p></div>';

            $("#cantidadProducto2").val('');

            $("#cantidad_salida2").val('');

            document.getElementById('botonGuardar2').style.display = 'none';

          }

        })

        $("#cantidad_salida2").focusout(function(){

          document.getElementById('alerta').innerHTML="";

          var cantidadRes = 0;

          var hiddenSalida = 0;

          var cantidadRestar = $("#cantidad_salida2").val();

          var hiddenSalida = $("#hiddenCantidadSalida").val();

          if (cantidadRestar<=cantidadActualizar) {

            var cantidadRes = cantidadActualizar-cantidadRestar;

            var hiddenSalida= Number(cantidadRestar)+Number(hiddenSalida);

            $("#cantidadProducto2").val(cantidadRes);

            $("#hiddenCantidadSalida2").val(hiddenSalida);

            console.log("cantidad", cantidadRes);
            console.log("cantidadSal", hiddenSalida);

            document.getElementById('botonGuardar2').style.display = 'inline';

          }else{
            document.getElementById('alerta2').innerHTML = '<div class="alert alert-warning"><p>No existen tantos productos</p></div>';

            $("#cantidadProducto2").val('');

            $("#cantidad_salida2").val('');

            document.getElementById('botonGuardar2').style.display = 'none';

          }

        })
          
      }
    }
  }); 
  }
   setInterval(salidas(), 1000);
});





/*=============================================
DataTable de Anuncios
=============================================*/

var tablaSalidas = $("#tablaSalidas").DataTable({

  processing: true,
  serverSide: true,

  ajax: {
    url: ruta + "/salidas"
  },

  "columnDefs": [{
            "searchable": true,
            "orderable": true,
            "targets": 0
        }],
  "order": [[ 0, 'desc' ]],
  columns: [{
    data: 'id_salida',
    name: 'id_salida'

  }, {
    data: 'nombre_producto',
    name: 'nombre_producto'

  }, {
    data: 'fecha_salida',
    name: 'fecha_salida'

  },
  {
    data: 'cantidad_salida',
    name: 'cantidad_salida'

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

tablaSalidas.on( 'order.dt search.dt', function () {
    tablaSalidas.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();
