@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <!-- Content Header (Page header) -->
  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">Respaldo</h1>

        </div><!-- /.col -->

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{ url("/") }}">Inicio</a></li>

            <li class="breadcrumb-item active">Respaldo</li>

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

               <form action="{{url('/')}}/backup/respaldo" method="get">

                @csrf
                <button class="btn my-2 bg-success">Crear nuevo Respaldo</button>

              </form>

            </div>
            <div class="card-body pb-5">
              @if (count($backups))
    <table class="table table-striped table-bordered rounded-sm">
        <thead class="thead-light">
            <tr>
                <th>Archivo</th>
                <th>Peso</th>
                <th>Fecha de creacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $backup)
                <tr>
                    <td>{{ $backup['file_name'] }}</td>
                    <td>{{ $backup['file_size'] }}</td>
                    <td>
                        {{ date('d/M/Y, g:ia', strtotime($backup['last_modified'])) }}
                    </td>
                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ url('backup/descarga/'.$backup['file_name']) }}">
                            <i class="fas fa-file-download"></i>
                            Descargar</a>
                        <a class="btn btn-danger" data-button-type="delete" href="{{ url('backup/elimina/'.$backup['file_name']) }}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center py-5">
        <h1 class="text-muted">No existen backups</h1>
    </div>
@endif
<br>
<div class="card border-primary mb-3" style="max-width: 18rem;">
  <div class="card-body text-info">
    <h5 class="card-title my-2">Informacion del modulo:</h5>
    <p class="card-text">En este modulo encontraras respaldos y podras realizar respaldos de la base de datos del sistema</p>
  </div>
            </div>

          </div>

        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->

  </div>
</div>  <!-- /.content -->
</div>



@if (Session::has("creado"))

  <script>
      notie.alert({ type: 1, text: '¡la copia de seguridad se ha hecho correctamente!', time: 10 })
 </script>

@endif

@endsection