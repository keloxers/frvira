@extends('layouts.default')

@section('content')


	<?php


		if (count($punteros)>0 )  {


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
											</tr>
										</thead>
										<tbody>


														<?php



													foreach ($punteros as $elector)
													{

															echo "<tr>";
													        echo "<td>";
																	echo "<a href='/electors/" . $elector->id . "/punteros'>";
																	echo '<span class="bg-success"> ';
																	echo '<b>';
																			echo $elector->matricula;
																	echo '</b>';
																	echo ' </span>';
																	echo '</a>';

																	echo "</td>";
																	echo "<td>" . $elector->clase . "</td>";
																	echo "<td>" . $elector->apellido . ", " . $elector->nombre . "</td>";


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
