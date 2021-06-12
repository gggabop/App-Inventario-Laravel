<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inversiones Mana Azur Hashem | Sistema</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="{{$blog[0]["icono"]}}">
	
	<!--=====================================
	PLUGINS DE CSS
	======================================-->

	{{-- BOOTSTRAP 4 --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<style>@import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
	* {
  box-sizing: inherit;
  transition-property: all;
  transition-duration: .6s;
  transition-timing-function: ease;
}
	body {
     font-family: 'Cabin', sans-serif !important;
}</style>

	{{-- OverlayScrollbars.min.css --}}
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/OverlayScrollbars.min.css">

	{{-- TAGS INPUT --}}
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/tagsinput.css">

	{{-- SUMMERNOTE --}}
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/summernote.css">

	{{-- NOTIE --}}
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/notie.css">

	<!-- DataTables -->
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/dataTables.bootstrap4.min.css">	
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/responsive.bootstrap.min.css">

	{{-- CSS AdminLTE --}}
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/adminlte.min.css">

	{{-- google fonts --}}
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



	<!--=====================================
	PLUGINS DE JS
	======================================-->

	{{-- Fontawesome --}}
	<script src="https://kit.fontawesome.com/e632f1f723.js" crossorigin="anonymous"></script>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	{{-- jquery.overlayScrollbars.min.js --}}
	<script src="{{ url('/') }}/js/plugins/jquery.overlayScrollbars.min.js"></script>

	{{-- TAGS INPUT --}}
	{{-- https://www.jqueryscript.net/form/Bootstrap-4-Tag-Input-Plugin-jQuery.html --}}
	<script src="{{ url('/') }}/js/plugins/tagsinput.js"></script>

	{{-- SUMMERNOTE --}}
	{{-- https://summernote.org/ --}}
	<script src="{{ url('/') }}/js/plugins/summernote.js"></script>

	{{-- NOTIE --}}
	{{-- https://github.com/jaredreich/notie --}}
	<script src="{{ url('/') }}/js/plugins/notie.js"></script>

	{{-- SWEET ALERT --}}
	{{-- https://sweetalert2.github.io/ --}}
	<script src="{{ url('/') }}/js/plugins/sweetalert.js"></script>

	<!-- DataTables 
	https://datatables.net/-->
	<script src="{{ url('/') }}/js/plugins/jquery.dataTables.min.js"></script>
	<script src="{{ url('/') }}/js/plugins/dataTables.bootstrap4.min.js"></script> 
	<script src="{{ url('/') }}/js/plugins/dataTables.responsive.min.js"></script>
	<script src="{{ url('/') }}/js/plugins/responsive.bootstrap.min.js"></script>	

	{{-- JS AdminLTE --}}
	<script src="{{ url('/') }}/js/plugins/adminlte.js"></script>

</head>

@if (Route::has('login'))

@auth

<body class="hold-transition sidebar-mini layout-fixed">

	<div class="wrapper">

		@include('modulos.header')

		@include('modulos.sidebar')

		@yield('content')

		@include('modulos.footer')


	</div>

<input type="hidden" id="ruta" value="{{url('/')}}">

<script src="{{url('/')}}/js/codigo.js"></script>
<script src="{{url('/')}}/js/administradores.js"></script>
<script src="{{url('/')}}/js/distribuidores.js"></script>
<script src="{{url('/')}}/js/productos.js"></script>
<script src="{{url('/')}}/js/entregas.js"></script>
<script src="{{url('/')}}/js/banner.js"></script>
<script src="{{url('/')}}/js/salidas.js"></script>

</body>

@else

@include('paginas.login')

@endauth

@endif	

</html>