@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <!-- Content Header (Page header) -->
  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">Salidas</h1>

        </div><!-- /.col -->

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{ url("/") }}">Inicio</a></li>

            <li class="breadcrumb-item active">Salidas</li>

          </ol>

        </div><!-- /.col -->

      </div><!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-lg-12">

          <div class="card card-primary card-outline">

            <div class="card-header">

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearSalida">Crear Salida</button>

              <form action="{{url('/')}}/salidasPDF" method="get">

                @csrf
                <button class="btn btn-success btn-sm my-2">Imprimir PDF</button>

              </form>

            </div>

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive" id="tablaSalidas" width="100%">

                <thead>

                  <tr>

                    <th width="10px">#</th>
                    <th width="500px">Producto</th>
                    <th>Fecha de salida</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>

                  </tr> 

                </thead>  

              </table>

    
              </div>

            </div>

          </div>         
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

<!--=====================================
Crear Salida
======================================-->

<div class="modal" id="crearSalida">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form action="{{url('/')}}/salidas" method="post">

        @csrf

        <div class="modal-header bg-info">
          <h4 class="modal-title">Crear Salida</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

           {{-- Contenido Anuncio --}}
           <div class="input-group-prepend">
              <label class="small">Ingrese el producto que desea sacar</label>
            </div>
           <div class="input-group">
            <select name="id_prod" class="form-control idProd" id="id_prod">
              <option value="">Seleccione un producto</option>
              @foreach ($productos as $element)
               <option value="{{$element->id_producto}}">{{$element->nombre_producto}}-{{$element->serial_producto}}</option>
              @endforeach
              <input type="hidden" name="actualizar_cantidad" id="cantidadProducto" value="">
            </select>
          </div>
        
          {{-- Pagina Anuncio --}}
             <div class="input-group-prepend">
              <label class="small">Ingresa la fecha de salida</label>
            </div>    
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>
            <input type="date" class="form-control" name="fecha_salida" required>
          </div>
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>
            <input type="number" class="form-control cantidad_salida" name="cantidad_salida" id="cantidad_salida" placeholder="ingrese la cantidad de producto que desea sacar" required>
          </div>
          <div align="center" class="alerta small h-75 text-center" id="alerta"></div>

        <!-- Modal footer -->
        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" style="display:none;" id="botonGuardar" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
@if (isset($status))
  @if ($status == 200)
    @foreach ($salida as $key => $value)
      
        <div class="modal" id="editarSalida">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form action="{{url('/')}}/salidas/{{$value->id_salida}}" method="post">

        @method('PUT')

        @csrf

        <div class="modal-header bg-info">
          <h4 class="modal-title">Editar Salida</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

           <div class="input-group-prepend">
              <label class="small">Ingrese el producto que desea sacar</label>
            </div>
           <div class="input-group">
            <select name="id_prod" class="form-control idProd2" id="id_prod2">
              @foreach ($productos as $element)
              @if ($value->id_prod == $element->id_producto)
                <option value="{{$element->id_producto}}" selected>{{$element->nombre_producto}}-{{$element->serial_producto}}</option>
              @endif
              @endforeach
              @foreach ($productos as $element)
                @if ($value->id_prod != $element->id_producto)
                  <option value="{{$element->id_producto}}">{{$element->nombre_producto}}-{{$element->serial_producto}}</option>
                @endif
              @endforeach
              <input type="hidden" name="actualizar_cantidad" id="cantidadProducto2" value="" required>
            </select>
          </div>
        
          {{-- Pagina Anuncio --}}
             <div class="input-group-prepend">
              <label class="small">Ingresa la fecha de salida</label>
            </div>    
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>
            <input type="date" class="form-control" name="fecha_salida" value="{{$value->fecha_salida}}" required>
          </div>
          <div class="input-group-prepend">
            <label class="small pb-1"> Articulos sacados hasta ahora: {{$value->cantidad_salida}}</label>
            </div>
          <div class="input-group mb-3">
            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>
            <input type="hidden" value="{{$value->cantidad_salida}}" id="hiddenCantidadSalida">
            <input type="hidden" value="{{$value->cantidad_salida}}" name="cantidad_salida" id="hiddenCantidadSalida2">
            <input type="number" class="form-control cantidad_salida2" id="cantidad_salida2" placeholder="ingrese la cantidad de producto que desea sacar" required>
          </div>
          <div align="center" class="alerta small h-75 text-center" id="alerta2"></div>


        <!-- Modal footer -->
        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" id="botonGuardar2" style="display: none;" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>

    @endforeach
      <script>
  $("#editarSalida").modal()
  </script>
  @endif
@endif

@if (Session::has("ok-crear"))

  <script>
      notie.alert({ type: 1, text: '¡la salida ha sido creada correctamente!', time: 10 })
 </script>

@endif


@if (Session::has("no-validacion"))

  <script>
      notie.alert({ type: 2, text: '¡Hay campos no válidos en la formulario!', time: 10 })
 </script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de salidas!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡la salida ha sido actualizado correctamente!', time: 10 })
 </script>

@endif

  @endsection
