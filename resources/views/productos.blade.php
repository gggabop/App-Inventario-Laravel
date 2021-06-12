<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabla Productos</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
	<header class="p-3 bg-primary text-white text-center mb-3" style="top: 0cm; left: 0cm; right: 0cm;"><span>Tabla Productos</span></header>
	<div class="container-fluid mx-auto">
		 <table class="table w-75 my-3" style="font-size: xx-small; margin-top: auto;">
			<thead class="thead-dark">
				<tr class="bg-success">
					<th scope="col">#</th>
					<th scope="col">Distribuidor</th>
					<th scope="col">Lote</th>
					<th scope="col">Nombre Producto</th>
					<th scope="col">Descripción producto</th>
					<th scope="col">Tipo Producto</th>
					<th scope="col">Peso Producto</th>
					<th scope="col">Valor Producto</th>
					<th scope="col">Serial Producto</th>
					<th scope="col">Cantidad Producto</th>
					<th scope="col">Fecha de Vencimiento</th>
					<th scope="col">Fecha de Elaboracion</th>
					<th scope="col">Existencia</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($productos as $element)
				<tr>
					<th scope="row">{{$element->id_producto}}</th>
					@foreach ($distribuidores as $distribuidor)
						@if ($element->id_dist == $distribuidor->id_distribuidor)
							<td>{{$distribuidor->nombre_distribuidor}}</td>
						@endif
					@endforeach
					@foreach ($entregas as $entrega)
						@if ($element->id_lote == $entrega->id_entrega)
							<td>{{$entrega->serial_entrega}}</td>
						@endif
					@endforeach
					<td>{{$element->nombre_producto}}</td>
					<td>{{$element->descripcion_producto}}</td>
					<td>{{$element->tipo_producto}}</td>
					<td>{{$element->peso_producto}}</td>
					<td>{{$element->valor_producto}}</td>
					<td>{{$element->serial_producto}}</td>
					<td>{{$element->cantidad_producto}}</td>
					<td>{{$element->fecha_vencimiento}}</td>
					<td>{{$element->fecha_elaboracion}}</td>
					@if ($element->p_eliminado==0)
						<td>En existencia</td>
					@else
						<td>Eliminado</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<footer class="p-3 bg-dark text-white fixed-bottom"><Span> Inversiones Mana Azur Hashem</Span></footer>
</body>

</html>