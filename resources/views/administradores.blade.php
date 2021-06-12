<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabla de administradores</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
	<header class="p-3 bg-primary text-white text-center mb-3" style="top: 0cm; left: 0cm; right: 0cm;"><span>Tabla de administradores</span></header>
	<div class="container-fluid mx-auto">
		 <table class="table my-3" style="font-size: x-small; margin-top: auto;">
			<thead class="thead-dark">
				<tr class="bg-success">
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Correo</th>
					<th scope="col">Foto</th>
					<th scope="col">Rol</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($administradores as $element)
				<tr>
					<th scope="row">{{$element->id}}</th>
					<td>{{$element->name}}</td>
					<td>{{$element->email}}</td>
					<td><img src="{{ url('/') }}/{{$element->foto}}" class="img-fluid rounded-circle"></td>
					<td>{{$element->rol}}</td>
				@endforeach
			</tbody>
		</table>
	</div>
	<footer class="p-3 bg-dark text-white fixed-bottom"><Span> Inversiones Mana Azur Hashem</Span></footer>
</body>

</html>