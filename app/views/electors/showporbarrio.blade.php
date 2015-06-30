@extends('layouts.default')

@section('content')


	<?php


		if (count($barrios)>0 )  {


?>
							<section class="panel panel-default">
								<header class="panel-heading">{{ $title }}</header>

								<div class="table-responsive">
									<table class="table table-striped b-t b-light text-sm">
										<thead>
											<tr>
												<th>Barrio</th>
												<th>Opciones</th>
											</tr>
										</thead>
										<tbody>


														<?php



													foreach ($barrios as $barrio)
													{

															echo "<tr>";
																	echo "<td>" . $barrio->barrio;
																	echo "<span class='badge bg-info pull-right'>";
																	$electores_por_barrio = Elector::Where('barrios_id', '=', $barrio->id)->count();
																	echo $electores_por_barrio;
																	echo "</span>";
																	echo "</td>";

																	echo "<td>";
																		echo "<a href='/electors/" . $barrio->id . "/barrios/votantestodos'>";
																		echo '<span class="bg-info"> ';
																		echo '<b>';
																				echo 'Todos';
																		echo '</b>';
																		echo ' </span>';
																		echo '</a> ';

																		echo "<a href='/electors/" . $barrio->id . "/barrios/votaron'>";
																		echo '<span class="bg-success"> ';
																		echo '<b>';
																				echo 'Votaron';
																		echo '</b>';
																		echo ' </span>';
																		echo '</a> ';

																		echo "<a href='/electors/" . $barrio->id . "/barrios/faltanvotaron'>";
																		echo '<span class="bg-warning"> ';
																		echo '<b>';
																				echo 'Faltan votar';
																		echo '</b>';
																		echo '</span>';
																		echo '</a>';
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
