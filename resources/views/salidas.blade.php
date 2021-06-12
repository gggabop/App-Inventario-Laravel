<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabla de salidas</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
	<header class="p-3 bg-primary text-white text-center mb-3" style="top: 0cm; left: 0cm; right: 0cm;"><span>Tabla de salidas</span></header>
	<div class="container-fluid mx-auto">
		 <table class="table my-3" style="font-size: x-small; margin-top: auto;">
			<thead class="thead-dark">
				<tr class="bg-success">
					<th scope="col">#</th>
					<th scope="col">Producto</th>
					<th scope="col">Fecha Salida</th>
					<th scope="col">Cantidad</th>
					<th>Existencia</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($salidas as $element)
				<tr>
					<th scope="row">{{$element->id_salida}}</th>
					@foreach ($productos as $element2)
						@if ($element->id_prod==$element2->id_producto)
							<th scope="row">{{$element2->nombre_producto}}-{{$element2->serial_producto}}</th>
						@endif
					@endforeach
					<td>{{$element->fecha_salida}}</td>
					<td>{{$element->cantidad_salida}}</td>
					@if ($element->s_eliminado==0)
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