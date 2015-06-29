@extends('layouts.default')

@section('content')


<div class="col-sm-6">
	<section class="panel panel-default">
		<header class="panel-heading font-bold">Buscar elector</header>
		<div class="panel-body">
			{{ Form::open(array('route' => 'electors.buscar', "autocomplete"=>"off"
, 'class' => 'panel-body wrapper-lg')) }}
			<div class="form-group">
				<label>Matricula</label>
				{{ Form::text('matricula', '', array('class' => 'form-control input-lg', 'placeholder' => 'Ingrese la matricula')) }}
				<?php

					if ($errors->
				first('matricula')) {
				?>
				<span class="badge bg-danger">{{ $errors->first('matricula') }}</span>

				<?php
					}
				?></div>



			<br>
			{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
			{{ Form::close() }}
		</div>
	</section>
</div>


	<?php


		if (count($electors)>0 )  {


?>
							<section class="panel panel-default">
								<header class="panel-heading">{{ $title }}</header>

								<div class="table-responsive">
									<table class="table table-striped b-t b-light text-sm">
										<thead>
											<tr>
												<th>Matricula</th>
												<th>Apellido y nombre</th>
												<th>Direccion</th>
												<th>Datos</th>
											</tr>
										</thead>
										<tbody>

												<?php



											foreach ($electors as $elector)
											{

													echo "<tr>";
											        echo "<td>" . $elector->matricula . "</td>";
															echo "<td>" . $elector->apellido . ", " . $elector->nombre . "</td>";
															echo "<td>" . $elector->domicilio . "</td>";

															echo "<td>";
																		$barrio = Barrio::find($elector->barrios_id);
																		if ($barrio) {
																			$barrio_id = $barrio->id;
																		} else {
																			$barrio_id = 0;
																		}
																		?>

																			{{ Form::open(array('route' => 'electors.grabarelector', "autocomplete"=>"off", 'class' => 'panel-body wrapper-lg')) }}
																			{{ Form::hidden('electors_id', $elector->id) }}
																			{{ Form::hidden('apellido', $apellido) }}

																			Barrio:<br>
																			{{ Form::select( 'barrio', Barrio::All()->lists('barrio', 'id'), $barrio->id, array( "placeholder" => "", 'class' => 'form-control input-sm')) }}
																		<?php
																		$categoria = Categoria::find($elector->categorias_id);
																		if ($categoria) {
																			$categoria_id = $categoria->id;
																		} else {
																			$categoria_id = 0;
																		}
																		?>
																			Categoria:<br>
																			{{ Form::select( 'categoria', Categoria::All()->lists('categoria', 'id'), $categoria->id, array( "placeholder" => "", 'class' => 'form-control input-sm')) }}
																		<?php

																		$puntero = Elector::find($elector->puntero_id);
																		if ($puntero) {
																			$puntero_id = $puntero->id;
																		} else {
																			$puntero_id = 0;
																		}

																		$punteros = Elector::where('categorias_id', '=' , 2)->get();

																		$seleccion[]= Array(0 => 'Sin definir');

																		foreach ($punteros as $puntero)
																		{

																			$seleccion[]= Array($puntero->id => $puntero->apellido . ', ' . $puntero->nombre);


																		}
																		$dtimeirbuscar = substr($elector->dtimeirbuscar, 0,5);
																		// $dtvot = str_replace(':', '', $dtvot);
																		?>
																			Puntero:<br>


																			{{Form::select('puntero_id', $seleccion, $elector->puntero_id, array( 'id' => 'puntero_id', 'name' => 'puntero_id', 'class' => 'form-control input-sm'))}}
																			Hora:<br>
																			{{ Form::text('dtimeirbuscar', $dtimeirbuscar, array('class' => 'form-control input-sm', 'placeholder' => 'HH:MM')) }}
																			<br>

																			{{ Form::submit('Grabar elector', array('class' => 'btn btn-primary')) }}
																			{{ Form::close() }}
																		<?php

															echo "</td>";



													print "</tr>";


											}


												?>


									</tbody>
								</table>
							</div>
							<footer class="panel-footer">

<div class="row">
									<div class="col-sm-4 hidden-xs">
										<!-- <select class="input-sm form-control input-s-sm inline">
											<option value="0">Bulk action</option>
											<option value="1">Delete selected</option>
											<option value="2">Bulk edit</option>
											<option value="3">Export</option>
										</select> -->
									</div>
									<div class="col-sm-4 text-center">
										<!-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> -->
									</div>

								</div>

							</footer>
						</section>
<?php

		}


	?>

<script src="/js/app.v2.js"></script>

@stop
