@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <!-- Content Header (Page header) -->
  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">Reportes</h1>

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

               <Span>Modulo de reportes</Span>


            </div>

            <div class="card-body ">
              
              <form action="{{url('/')}}/productosPDF" method="get">

                @csrf
                <button class="btn btn-block my-2 bg-success">Imprimir PDF Tabla productos</button>

              </form>

              <form action="{{url('/')}}/administradoresPDF" method="get">

                @csrf
                <button class="btn btn-block my-2 bg-danger">Imprimir PDF Tabla administradores</button>

              </form>

              <form action="{{url('/')}}/distribuidoresPDF" method="get">

                @csrf
                <button class="btn btn-block my-2 bg-warning">Imprimir PDF Tabla distribuidores</button>

              </form>

              <form action="{{url('/')}}/entregasPDF" method="get">

                @csrf
                <button class="btn btn-block my-2 bg-info bg-light">Imprimir PDF Tabla entregas</button>

              </form>

              <form action="{{url('/')}}/salidasPDF" method="get">

                @csrf
                <button class="btn btn-block my-2 bg-dark">Imprimir PDF Tabla salidas</button>

              </form>
      
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

@if (Session::has("ok-descargado"))

  <script>
      notie.alert({ type: 1, text: '¡El Banner se ha creado correctamente!', time: 10 })
 </script>

@endif

@endsection