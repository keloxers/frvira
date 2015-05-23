@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


	<div class="row">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('/ciudads') }}">Barrios</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('ciudads/create') }}">Crear nuevo barrio</a>
	</ul>
</nav>


		<div class="col-sm-6">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">{{ $title }}</header>
				<div class="panel-body">
					{{ Form::open(array('url' => URL::to('/barrios/' . $barrio->id), 'method' => 'PUT', 'class' => 'panel-body wrapper-lg')) }}

						<div class="form-group">
							<label>Barrio</label>
							{{ Form::text('barrio', $barrio->barrio, array('class' => 'form-control input-lg', 'placeholder'
							 => 'Ingrese un barrio')) }}<br></div>
							<?php

							if ($errors->first('barrio')) {
								?>

									<span class="badge bg-danger">{{ $errors->first('barrio') }}</span>

								<?php
							}
							?>







						{{ Form::submit('Modificar', array('class' => 'btn btn-primary')) }}
				</div>
			</section>
		</div>
	</div>
<script src="/js/app.v2.js"></script>

<script>

var jq = jQuery.noConflict();
    jq(document).ready( function(){


    $("#provincia").autocomplete({
		source: "/provincias/search",
      	select: function( event, ui ) {
      		$( '#provincias_id' ).val( ui.item.id );
      }
  });


});


</script>
@stop
