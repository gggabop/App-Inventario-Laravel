<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabla de entregas</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
	<header class="p-3 bg-primary text-white text-center mb-3" style="top: 0cm; left: 0cm; right: 0cm;"><span>Tabla de entregas</span></header>
	<div class="container-fluid mx-auto">
		 <table class="table my-3" style="font-size: x-small; margin-top: auto;">
			<thead class="thead-dark">
				<tr class="bg-success">
					<th scope="col">#</th>
					<th scope="col">Nombre Distribuidor</th>
					<th scope="col">Productos en la lote</th>
					<th scope="col">Codigo Entrega</th>
					<th scope="col">Fecha de ingreso</th>
					<th scope="col">Existencia</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($entregas as $element)
				<tr>
					<th scope="row">{{$element->id_entrega}}</th>
					@foreach ($distribuidores as $element2)
						@if ($element->id_distentrega==$element2->id_distribuidor)
							<th scope="row">{{$element2->nombre_distribuidor}}</th>
						@endif
					@endforeach
					@php
					$tags = json_decode($element->productos_entrega, true); 

					$productos_entrega = '';

					foreach ($tags as $key => $value) {

						$productos_entrega .= ' '.$value.',';
					}
					$productos_entrega = substr($productos_entrega, 0, -1);

					@endphp
					<td>{{$productos_entrega}}</td>
					<td>{{$element->serial_entrega}}</td>
					<td>{{$element->fecha_entrega}}</td>
					@if ($element->e_eliminado==0)
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