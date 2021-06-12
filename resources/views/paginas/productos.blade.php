@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Productos</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

            <li class="breadcrumb-item active">Productos</li>

          </ol>

        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-12">

          <!-- Default box -->
          <div class="card">

            <div class="card-header">

               <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearProducto">Crear nuevo producto</button>

               <form action="{{url('/')}}/productosPDF" method="get">

                @csrf
                <button class="btn btn-success btn-sm my-2">Imprimir PDF</button>

              </form>

            </div>

            <div class="card-body">

             {{--  <ul>

              @foreach ($articulos as $key => $value)
                 
                  <li>
                    
                    <h3>{{ $value["titulo_articulo"] }}</h3>
                    <h5>{{ $value->categorias["titulo_categoria"] }}</h5>
                  </li>

                @endforeach

              </ul> --}}

              <table class="table table-bordered table-striped dt-responsive" id="tablaProductos" width="100%">

                <thead>

                  <tr>

                    <th width="10px">#</th>
                    <th width="14px">Distribuidor</th>
                    <th>Serial del lote</th>
                    <th>Nombre del producto</th>
                    <th>Descripcion del producto</th>
                    <th>Tipo de producto</th>
                    <th width="5px">Peso</th>
                    <th>Valor</th>
                    <th>Serial</th>
                    <th>Cantidad</th>
                    <th>Fecha de Elaboracion</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Acciones</th>         

                  </tr> 

                </thead>  

              </table>

            </div>

            <!-- /.card-body -->
           
          </div>
          <!-- /.card -->
        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->
</div>

<!--=====================================
Crear Producto
======================================-->

<div class="modal" id="crearProducto">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form action="{{url('/')}}/productos" method="post">

        @csrf

        <div class="modal-header bg-info">
          <h4 class="modal-title">Crear Producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

           {{-- Título Categoría --}}
           
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <select class="form-control"  name="id_dist" required>

              <option value="">Elige el distribuidor</option>
             
              @foreach ($distribuidores as $key => $value)
              
                <option value="{{$value->id_distribuidor}}">{{$value->nombre_organizacion}}</option>

              @endforeach

            </select>
            
          </div>

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <select class="form-control"  name="id_lote" required>

              <option value="">Elige el lote de entrega</option>
             
              @foreach ($entregas as $key => $value)
              
                <option value="{{$value->id_entrega}}">{{$value->serial_entrega}}</option>

              @endforeach

            </select>
            
          </div>
        
          {{-- Título articulo --}}
                    
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-carrot"></i>
            </div>

            <input type="text" class="form-control" name="nombre_producto" placeholder="Ingrese el nombre del producto" value="{{old("nombre_producto")}}" required> 

          </div>


          {{-- Descripción artículo --}}
                  
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-pencil-alt"></i>
            </div>

            <input type="text" class="form-control" name="descripcion_producto" placeholder="Ingrese la descripción del artículo" value="{{old("descripcion_producto")}}" maxlength="220" required> 

          </div> 

           {{-- Ruta artículo --}}
                  
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-cart-plus"></i>
            </div>

            <select class="form-control" name="tipo_producto" id="tipo_producto" required>
              <option value="">Elige la calidad del producto</option>
              <option value="premium">Tipo Premiun</option>
              <option value="general">Tipo General</option>
              <option value="generico">Tipo Generico</option>
            </select>

          </div>

          <div class="input-group mb-3">
              <input type="number" name="peso_producto" class="form-control" placeholder="Ingrese el peso del producto" aria-label="Text input with segmented dropdown button" value="{{old("peso_producto")}}">
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary" id="label-peso">Escoge el peso</button>
              <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item kilogramos">Kilogramos</a>
                <a class="dropdown-item gramos">Gramos</a>
                <a class="dropdown-item litros">Litros</a>
                <a class="dropdown-item mililitros">Mililitros</a>
                <input type="hidden" name="extension_peso" id="input-peso" value="" required>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-dollar-sign"></i>
            </div>

            <input type="number" class="form-control" name="valor_producto" placeholder="Ingrese el precio del producto" value="{{old("valor_producto")}}" required> 

          </div>

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-barcode"></i>
            </div>

            <input type="text" class="form-control inputSerial" name="serial_producto" placeholder="Ingrese el serial del producto" value="{{old("serial_producto")}}" maxlength="20" required> 

          </div>

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-cart-arrow-down"></i>
            </div>

            <input type="number" class="form-control" name="cantidad_producto" placeholder="Ingrese la cantidad de unidades de producto" value="{{old("cantidad_producto")}}" required> 

          </div>
          <span class="small">Ingrese Fecha de elaboracion del producto</span>
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-calendar-alt"></i>
            </div>

            <input type="date" class="form-control" name="fecha_elaboracion" id="fecha_elaboracion" placeholder="Ingrese Fecha de elaboracion del producto" value="{{old("fecha_elaboracion")}}" required> 

          </div>
          <span class="small">Ingrese Fecha de vencimiento del producto</span>
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-calendar-alt"></i>
            </div>

            <input type="date" class="form-control fecha_vencimiento" name="fecha_vencimiento" id="fecha_vencimiento" placeholder="Ingrese Fecha de vencimiento del producto" value="{{old("fecha_vencimiento")}}" required> 

          </div> 
        </div>

        <!-- Modal footer -->
        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
Modal Editar Artículo
======================================-->

@if (isset($status))
                 
  @if ($status == 200)
    
    @foreach ($producto as $key => $value)

      <div class="modal" id="editarProducto">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">

           <form action="{{url('/')}}/productos/{{$value->id_producto}}" method="post">

              @method('PUT')

              @csrf

            <div class="modal-header bg-info">
              <h4 class="modal-title">Editar Producto</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            
            <div class="modal-body">

           {{-- Título Categoría --}}
           
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <select class="form-control"  name="id_dist" required>
             
              @foreach ($distribuidores as $key => $value2)

              @if ($value["id_dist"]==$value2["id_distribuidor"])
               <option value="{{$value2->id_distribuidor}}">{{$value2->nombre_organizacion}}</option>
              @endif
              
              @endforeach

              @foreach ($distribuidores as $key => $value3)
                @if ($value["id_dist"]!=$value3["id_distribuidor"])
                  <option value="{{$value3->id_distribuidor}}">{{$value3->nombre_organizacion}}</option>
                @endif
              @endforeach

            </select>
            
          </div>

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <select class="form-control"  name="id_lote" required>
             
              @foreach ($entregas as $key => $value2)

              @if ($value["id_lote"]==$value2["id_entrega"])
               <option value="{{$value2->id_entrega}}">{{$value2->serial_entrega}}</option>
              @endif
              
              @endforeach

              @foreach ($entregas as $key => $value3)
                @if ($value["id_lote"]!=$value3["id_entrega"])
                  <option value="{{$value3->id_entrega}}">{{$value3->serial_entrega}}</option>
                @endif
              @endforeach

            </select>
            
          </div>
        
          {{-- Título articulo --}}
                    
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-carrot"></i>
            </div>

            <input type="text" class="form-control" name="nombre_producto" placeholder="Ingrese el nombre del producto" value="{{$value->nombre_producto}}" required> 

          </div>


          {{-- Descripción artículo --}}
                  
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-pencil-alt"></i>
            </div>

            <input type="text" class="form-control" name="descripcion_producto" placeholder="Ingrese la descripción del artículo" value="{{$value->descripcion_producto}}" maxlength="220" required> 

          </div> 

           {{-- Ruta artículo --}}
                  
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-cart-plus"></i>
            </div>

            <select class="form-control" name="tipo_producto" id="tipo_producto" required>
              @if ($value["tipo_producto"]=="premium")
                <option value="premium" selected>Tipo Premium</option>
                <option value="general">Tipo General</option>
                <option value="generico">Tipo Generico</option>
              @endif
              @if ($value["tipo_producto"]=="general")
                <option value="premium">Tipo Premium</option>
                <option value="general" selected>Tipo General</option>
                <option value="generico">Tipo Generico</option>
              @endif
              @if ($value["tipo_producto"]=="generico")
                <option value="premium">Tipo Premium</option>
                <option value="general" >Tipo General</option>
                <option value="generico"selected>Tipo Generico</option>
              @endif
            </select>

          </div>

          <div class="input-group mb-3">
            @if (substr($value->peso_producto, -2)=="ml" || substr($value->peso_producto, -2)=="kg")
              <input type="number" name="peso_producto" class="form-control" placeholder="Ingrese el peso del producto" aria-label="Text input with segmented dropdown button" value="{{substr($value->peso_producto, 0, -2)}}">
            @else
              <input type="number" name="peso_producto" class="form-control" placeholder="Ingrese el peso del producto" aria-label="Text input with segmented dropdown button" value="{{substr($value->peso_producto, 0, -1)}}">
            @endif
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary" id="label-peso-update">Escoge el peso</button>
              <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item kilogramos-update">Kilogramos</a>
                <a class="dropdown-item gramos-update">Gramos</a>
                <a class="dropdown-item litros-update">Litros</a>
                <a class="dropdown-item mililitros-update">Mililitros</a>
                @if (substr($value->peso_producto, -2)=="ml" || substr($value->peso_producto, -2)=="kg")
                <input type="hidden" name="extension_peso" id="input-peso-update" value="{{substr($value->peso_producto, -2)}}" required>
                @else
                <input type="hidden" name="extension_peso" id="input-peso-update" value="{{substr($value->peso_producto, -1)}}" required>
                @endif
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <input type="number" class="form-control" name="valor_producto" placeholder="Ingrese el precio del producto" value="{{$value->valor_producto}}" required> 

          </div>

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-barcode"></i>
            </div>

            <input type="text" class="form-control inputSerial" name="serial_producto" placeholder="Ingrese el serial del producto" value="{{$value->serial_producto}}" maxlength="20" required> 

          </div>

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-cart-arrow-down"></i>
            </div>

            <input type="number" class="form-control" name="cantidad_producto" placeholder="Ingrese la cantidad de unidades de producto" value="{{$value->cantidad_producto}}" required> 

          </div>
          <span class="small">Ingrese Fecha de elaboracion del producto</span>
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-calendar-alt"></i>
            </div>

            <input type="date" class="form-control" name="fecha_elaboracion" id="fecha_elaboracion_update" placeholder="Ingrese Fecha de elaboracion del producto" value="{{$value->fecha_elaboracion}}" required> 

          </div>
		<span class="small">Ingrese Fecha de vencimiento del producto</span>
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-calendar-alt"></i>
            </div>

            <input type="date" class="form-control fecha_vencimiento_update" id="fecha_vencimiento_update" name="fecha_vencimiento" placeholder="Ingrese Fecha de vencimiento del producto" value="{{$value->fecha_vencimiento}}" required> 

          </div> 
        </div>

            <!-- Modal footer -->
            <div class="modal-footer d-flex justify-content-between">

              <div>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>

              <div>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>

            </div>

          </form>

        </div>

      </div>

    </div>

  @endforeach

  <script>
  $("#editarProducto").modal()
  </script>

  @endif

@endif

@if (Session::has("ok-crear"))

  <script>
      notie.alert({ type: 1, text: '¡El producto ha sido creado correctamente!', time: 10 })
 </script>

@endif



@if (Session::has("no-validacion"))

  <script>
      notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
 </script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de productos!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡El producto ha sido actualizado correctamente!', time: 10 })
 </script>

@endif

@endsection