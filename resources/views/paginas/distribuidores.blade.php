@foreach ($administradores as $element)

@if ($_COOKIE["email_login"] == $element->email)
               
@if ($element->rol == "administrador" || $element->rol=="inventario")

@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Distribuidores</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

            <li class="breadcrumb-item active">Distribuidores</li>

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

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearDistribuidor">Crear nuevo distribuidor</button>

              <form action="{{url('/')}}/distribuidoresPDF" method="get">

                @csrf
                <button class="btn btn-success btn-sm my-2">Imprimir PDF</button>

              </form>

            </div>

            <div class="card-body">

            {{--   @foreach ($categorias as $element)
                  {{ $element }}
                @endforeach --}}

              <table class="table table-bordered table-striped dt-responsive" id="tablaDistribuidores" width="100%">
              
                <thead>
                  
                  <tr>
                    
                    <th width="10px">#</th>
                    <th>Nombre Distribuidor</th>
                    <th>Nombre Organizacion</th>
                    <th>Descripcion Distribuidor</th>
                    <th>Acciones</th>

                  </tr>


                </thead>

                <tbody>
                  

                </tbody>  

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
Crear Distribuidor
======================================-->
<div class="modal" id="crearDistribuidor">

  <div class="modal-dialog">

    <div class="modal-content">

      <form action="{{url('/')}}/distribuidores" method="post" enctype="multipart/form-data">

       @csrf
        
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Distribuidor</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">
          
           {{-- nombre distribuidor --}}

           <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <input type="text" class="form-control" name="nombre_distribuidor" placeholder="Ingrese el nombre del distribuidor" value="{{old("nombre_distribuidor")}}" required> 

          </div> 

          {{-- nombre organizacion--}}

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-pencil-alt"></i>
            </div>

            <input type="text" class="form-control" name="nombre_organizacion" placeholder="Ingrese el nombre de la organizacion" value="{{old("nombre_organizacion")}}" required> 

          </div> 

          {{-- Descripcion Distribuidor --}}

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-link"></i>
            </div>

            <input type="text" class="form-control" name="descripcion_distribuidor" placeholder="Ingrese la descripcion del distribuidor (opcional)" value="{{old("descripcion_distribuidor")}}"  maxlength="30"> 

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
Editar Categorías
======================================-->

@if (isset($status))

  @if ($status == 200)

    @foreach ($distribuidor as $key => $value)
  
      <div class="modal" id="editarDistribuidor">

        <div class="modal-dialog">

          <div class="modal-content">

            <form action="{{url('/')}}/distribuidores/{{$value->id_categoria}}" method="post">

              @method('PUT')

              @csrf
              
              <div class="modal-header bg-info">
                
                <h4 class="modal-title">Editar Distribuidor</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>

              <div class="modal-body">
                
                 {{-- Título categoría --}}

                 <div class="input-group mb-3">

                  <div class="input-group-append input-group-text">
                    <i class="fas fa-list-ul"></i>
                  </div>

                  <input type="text" class="form-control" name="nombre_distribuidor" placeholder="Ingrese el nombre del distribuidor" value="{{$value->nombre_distribuidor}}" required> 

                </div> 

                {{-- Descripción categoría --}}

                <div class="input-group mb-3">
           
                  <div class="input-group-append input-group-text">
                    <i class="fas fa-pencil-alt"></i>
                  </div>

                  <input type="text" class="form-control" name="nombre_organizacion" placeholder="Ingrese el nombre de la organizacion" value="{{$value->nombre_organizacion}}" required> 

                </div> 

                {{-- Ruta categoría --}}

                <div class="input-group mb-3">
           
                  <div class="input-group-append input-group-text">
                    <i class="fas fa-link"></i>
                  </div>

                  <input type="text" class="form-control" name="descripcion_distribuidor" placeholder="Ingrese la descripcion del distribuidor (opcional)" value="{{$value->descripcion_distribuidor}}"> 

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

    @endforeach

    <script>$("#editarDistribuidor").modal()</script>

  @endif

@endif

@if (Session::has("ok-crear"))

  <script>
      notie.alert({ type: 1, text: '¡El distribuidor ha sido creada correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-validacion"))

  <script>
      notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
 </script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de distribuidores!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡El distribuidor ha sido actualizado correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-borrar"))

  <script>
      notie.alert({ type: 3, text: '¡Error al borrar el distribuidor!', time: 10 })
 </script>

@endif

@endsection

@else

<script>window.location="{{url('/entregas')}}"</script>

@endif

@endif
           
@endforeach 
