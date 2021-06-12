@foreach ($administradores as $element)

@if ($_COOKIE["email_login"] == $element->email)
               
@if ($element->rol == "administrador")

@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Administradores</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

            <li class="breadcrumb-item active">Administradores</li>

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

             <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearAdministrador">Crear nuevo administrador</button>

             <form action="{{url('/')}}/administradoresPDF" method="get">

                @csrf
                <button class="btn btn-success btn-sm my-2">Imprimir PDF</button>

              </form>

            </div>

            <div class="card-body">


              <table class="table table-bordered table-striped dt-responsive" width="100%" id="tablaAdministradores">
                
                <thead>

                  <tr>
                    
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th width="50px">Foto</th>
                    <th>Rol</th>
                    <th>Acciones</th>

                  </tr>              

                </thead>

                <tbody>

                 {{--  @foreach ($administradores as $key => $value)
                  
                    <tr>
                     
                      <td>{{($key+1)}}</td> 
                      <td>{{($value["name"])}}</td> 
                      <td>{{($value["email"])}}</td> 
                      

                      @php

                      if($value["foto"] == ""){

                        echo '<td><img src="'.url('/').'/img/administradores/admin.png" class="img-fluid rounded-circle"></td>';

                      }else{


                        echo '<td><img src="'.url('/').'/'.$value["foto"].'" class="img-fluid rounded-circle"></td>';

                      }

                      if($value["rol"] == ""){

                        echo '<td>administrador</td>';

                      }else{

                        echo '<td>'.$value["rol"].'</td>';
                      }
                       
                      @endphp

                      <td>
                        <div class="btn-group">
                          
                          <a href="{{url('/')}}/administradores/{{$value["id"]}}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt text-white"></i>
                          </a>

                          <button class="btn btn-danger btn-sm eliminarRegistro" action="{{url('/')}}/administradores/{{$value["id"]}}" method="DELETE" pagina="administradores">
                            @csrf 
                            <i class="fas fa-trash-alt"></i>

                          </button>
 --}}


                         {{--  <form method="post" action="{{url('/')}}/administradores/{{$value["id"]}}"> 

                            <input type="hidden" name="_method" value="DELETE">
                            @csrf

                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          
                          </form>--}}

                 {{--        </div> 


                      </td> 



                    </tr>



                  @endforeach --}}
                  


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
Crear Administrador
======================================-->

<div class="modal" id="crearAdministrador">
 
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form method="POST" action="{{ route('register') }}">
        @csrf
      
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Administrador</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

            {{-- Nombre --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-user"></i>
              </div>

              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre">

              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror

            </div>

            {{-- Email --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-envelope"></i>
              </div>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror

            </div>

            {{-- Password --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-key"></i>
              </div>

              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña mínimo de 8 caracteres">

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror

            </div>

            {{-- Confirmar Password --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-key"></i>
              </div>

              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">

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
Editar administrador
======================================-->

@if (isset($status))

  @if ($status == 200)
   
    @foreach ($administrador as $key => $value)
      
      <div class="modal" id="editarAdministrador">
       
        <div class="modal-dialog">
         
          <div class="modal-content">

            <form method="POST" action="{{url('/')}}/administradores/{{$value["id"]}}" enctype="multipart/form-data">

              @method('PUT')
              @csrf
            
              <div class="modal-header bg-info">
                
                <h4 class="modal-title">Editar Administrador</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>

              <div class="modal-body">

                  {{-- Nombre --}}

                  <div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">               
                       <i class="fas fa-user"></i>
                    </div>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $value["name"] }}" required autocomplete="name" autofocus placeholder="Nombre">

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  {{-- Email --}}

                  <div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">               
                       <i class="fas fa-envelope"></i>
                    </div>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $value["email"] }}" required autocomplete="email" placeholder="Email">

                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  {{-- Password --}}

                  <div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">               
                       <i class="fas fa-key"></i>
                    </div>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Contraseña mínimo de 8 caracteres">

                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <input type="hidden" name="password_actual" value="{{$value["password"]}}">

                  {{-- Rol --}}
                  
                  <div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-list-ul"></i>
                    </div>

                    <select class="form-control"  name="rol" required>

                      @if ($value["rol"] == "administrador" || $value["rol"] == "")

                        <option value="administrador">administrador</option>
                        <option value="inventario">inventario</option>
                        <option value="envios-entradas">Envios y entradas</option>

                      @endif

                      @if ($value["rol"] == "inventario")
                        <option value="inventario">inventario</option>
                        <option value="administrador">administrador</option>
                        <option value="envios-entradas">Envios y entradas</option>

                      @endif

                      @if ($value["rol"] == "envios-entradas")
                        <option value="envios-entradas">Envios y entradas</option>
                        <option value="administrador">administrador</option>
                        <option value="inventario">inventario</option>
                      @endif


                    </select>

                  </div>
                  
                  {{-- Foto --}}
                  <hr class="pb-2">

                  <div class="form-group my-2 text-center">
                  
                    <div class="btn btn-default btn-file">
                      
                      <i class="fas fa-paperclip"></i> Adjuntar Foto

                      <input type="file" name="foto">

                    </div> 

                    <br>

                    @if ($value["foto"] == "")

                     <img src="{{url('/')}}/img/administradores/admin.png" class="previsualizarImg_foto img-fluid py-2 w-25 rounded-circle">
                      
                    @else 

                     <img src="{{url('/')}}/{{$value["foto"]}}" class="previsualizarImg_foto img-fluid py-2 w-25 rounded-circle">

                    @endif

                    <input type="hidden" value="{{$value["foto"]}}" name="imagen_actual">

                    <p class="help-block small">Dimensiones: 200px * 200px | Peso Max. 2MB | Formato: JPG o PNG</p>

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

    <script>
  
     $("#editarAdministrador").modal();

    </script>

    @else

    {{$status}}

  @endif
 
@endif

@if (Session::has("no-validacion"))

<script>
    notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
</script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de administradores!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡El administrador ha sido actualizado correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("ok-eliminar"))

  <script>
      notie.alert({ type: 1, text: '¡El administrador ha sido eliminado correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-borrar"))

  <script>
      notie.alert({ type: 2, text: '¡Este administrador no se puede borrar!', time: 10 })
 </script>

@endif

@endsection

@else

<script>window.location="{{url('/categorias')}}"</script>

@endif

@endif
           
@endforeach 


