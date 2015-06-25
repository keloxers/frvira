@extends('layouts.default')

@section('content')


<div class="col-sm-6">
	<section class="panel panel-default">
		<header class="panel-heading font-bold">Buscar elector</header>
		<div class="panel-body">
			{{ Form::open(array('route' => 'showlistarelectors', "autocomplete"=>"off"
, 'class' => 'panel-body wrapper-lg')) }}
			<div class="form-group">
				<label>Letra o texto inicia</label>
				{{ Form::text('apellido', $apellido, array('class' => 'form-control input-lg', 'placeholder' => 'Ingrese letras iniciales')) }}
				<?php

					if ($errors->
				first('apellido')) {
				?>
				<span class="badge bg-danger">{{ $errors->first('apellido') }}</span>

				<?php
					}
				?></div>



			<br>
			{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
			{{ Form::close() }}
		</div>
	</section>
</div>
<div class="col-sm-6">
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
												<th>Clase</th>
												<th>Apellido y nombre</th>
												<th>Direccion</th>
												<th>Barrio</th>
												<th>Puntero</th>
											</tr>
										</thead>
										<tbody>


														<?php



													foreach ($electors as $elector)
													{

															echo "<tr>";
													        echo "<td>";
																	echo "<a href='/electors/" . $elector->id . "/" . $apellido . "/edit'>";
																	echo '<span class="bg-success"> ';
																	echo '<b>';
																			echo $elector->matricula;
																	echo '</b>';
																	echo ' </span>';
																	echo '</a>';

																	echo "</td>";
																	echo "<td>" . $elector->clase . "</td>";
																	echo "<td>" . $elector->apellido . ", " . $elector->nombre . "</td>";
																	echo "<td>" . $elector->domicilio . "</td>";

																	echo "<td>";
																				$barrio = Barrio::find($elector->barrios_id);
																				if ($elector->barrios_id > 1) {
																					echo '<span class="label bg-success">' . $barrio->barrio . '</span>';
																					echo '<br>';
																				} else {
																					echo '<span class="label bg-danger">No asignado</span>';
																					echo '<br>';
																				}

																	echo "</td>";

																	echo "<td>";
																				$puntero = Elector::find($elector->puntero_id);
																				if ($puntero) {
																					$puntero_id = $puntero->id;
																					echo '<span class="label bg-info">' . $puntero->apellido .', ' . $puntero->nombre . '</span>';
																					echo '<br>';

																				} else {
																					$puntero_id = 0;
																					echo '<span class="label bg-danger">No asignado</span>';
																					echo '<br>';
																				}
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
