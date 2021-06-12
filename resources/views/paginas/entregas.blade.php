@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

   <!-- Content Header (Page header) -->
  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">Entregas</h1>
          
        </div><!-- /.col -->
        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{ url("/") }}">Inicio</a></li>

            <li class="breadcrumb-item active">Entregas</li>

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

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearEntrega">Crear Entrega</button>

              <form action="{{url('/')}}/entregasPDF" method="get">

                @csrf
                <button class="btn btn-success btn-sm my-2">Imprimir PDF</button>

              </form>

            </div>

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive" id="tablaEntregas" width="100%">

                <thead>

                  <tr>

                    <th width="10px">#</th>
                    <th>Distribuidor</th>
                    <th>Productos en entrega</th>
                    <th>Codigo de entrega</th>
                    <th>Fecha de ingreso</th>                
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
Crear Entrega
======================================-->
<div class="modal" id="crearEntrega">

  <div class="modal-dialog">

    <div class="modal-content">

      <form action="{{url('/')}}/entregas" method="post">

       @csrf
        
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Entrega</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">
          
           {{-- nombre distribuidor --}}

           <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <select name="id_distentrega" class="form-control">
                <option value="">Escoge el distribuidor que entrego los productos</option>
              @foreach ($distribuidores as $element)
                <option value="{{$element->id_distribuidor}}">{{$element->nombre_organizacion}}</option>
              @endforeach
            </select>

          </div> 

          {{--Productos entrega--}}

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-pencil-alt"></i>
            </div>
            <span class="small">Ingresar los productos separados por coma</span>
            <input type="text" class="form-control" name="productos_entrega" data-role="tagsinput" required> 

          </div> 

          {{-- Descripcion Distribuidor --}}

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-link"></i>
            </div>

            <input type="text" class="form-control" name="serial_entrega" placeholder="Ingrese el codigo de la entrega" value="{{old("serial_entrega")}}"  maxlength="30" required> 

          </div>

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-link"></i>
            </div>

            <input type="date" class="form-control" name="fecha_entrega" placeholder="Ingrese la fecha de entrega" required> 

          </div> 

        </div>

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
    
    @foreach ($entrega as $value)

    <div class="modal" id="editarEntrega">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">

           <form action="{{url('/')}}/entregas/{{$value->id_entrega}}" method="post">

              @method('PUT')

              @csrf

            <div class="modal-header bg-info">
              <h4 class="modal-title">Editar Opinion</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
          
           {{-- nombre distribuidor --}}

           <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <select name="id_distentrega" class="form-control">
              @foreach ($distribuidores as $element)
                @if ($element->id_distribuidor == $value->id_distentrega)
                  <option value="{{$element->id_distribuidor}}" selected>{{$element->nombre_organizacion}}</option>
                @endif
              @endforeach
              @foreach ($distribuidores as $element)
                @if ($element->id_distribuidor != $value->id_distentrega)
                  <option value="{{$element->id_distribuidor}}">{{$element->nombre_organizacion}}</option>
                @endif
              @endforeach
            </select>

          </div> 

          {{--Productos entrega--}}

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-pencil-alt"></i>
            </div>
            @php

            $tags = json_decode($value->productos_entrega, true);

            $productos_entrega = "";

            foreach ($tags as $key => $value2) {

              $productos_entrega .= $value2.",";

            }

            @endphp
            <span class="small">Ingresar los productos separados por coma</span>
            <input type="text" class="form-control" name="productos_entrega" data-role="tagsinput" value="{{$productos_entrega}}" required> 
          </div> 

          {{-- Descripcion Distribuidor --}}

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-link"></i>
            </div>

            <input type="text" class="form-control" name="serial_entrega" placeholder="Ingrese el codigo de la entrega" value="{{$value->serial_entrega}}"  maxlength="30" required> 

          </div>

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-link"></i>
            </div>

            <input type="date" class="form-control" name="fecha_entrega" placeholder="Ingrese la fecha de entrega" value="{{$value->fecha_entrega}}" required> 

          </div> 

        </div>
            <div class="modal-footer d-flex justify-content-between">

              <div>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>

              <div>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  @endforeach

  <script>
  $("#editarEntrega").modal()
  </script>

  @endif

@endif

@if (Session::has("ok-crear"))

  <script>
      notie.alert({ type: 1, text: '¡la Entrega ha sido creada correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-validacion"))

  <script>
      notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
 </script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de Entregas!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡La Entrega ha sido actualizado correctamente!', time: 10 })
 </script>

@endif

@endsection