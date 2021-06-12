<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabla de distribuidores</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
	<header class="p-3 bg-primary text-white text-center mb-3" style="top: 0cm; left: 0cm; right: 0cm;"><span>Tabla de distribuidores</span></header>
	<div class="container-fluid mx-auto">
		 <table class="table my-3" style="font-size: x-small; margin-top: auto;">
			<thead class="thead-dark">
				<tr class="bg-success">
					<th scope="col">#</th>
					<th scope="col">Nombre Distribuidor</th>
					<th scope="col">Nombre Organizacion</th>
					<th scope="col">Descripcion Distribuidor</th>
					<th scope="col">Existencia</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($distribuidores as $element)
				<tr>
					<th scope="row">{{$element->id_distribuidor}}</th>
					<td>{{$element->nombre_distribuidor}}</td>
					<td>{{$element->nombre_organizacion}}</td>
					<td>{{$element->descripcion_distribuidor}}</td>
					@if ($element->d_eliminado == 0)
						<td>En existencia</td>
					@else
						<td>Eliminado</td>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
	<footer class="p-3 bg-dark text-white fixed-bottom"><Span> Inversiones Mana Azur Hashem</Span></footer>
</body>

</html>