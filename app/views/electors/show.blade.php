@extends('layouts.default')

@section('content')


<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('/ciudads') }}">Barrio</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('ciudads/create') }}">Crear nueva barrio</a>
	</ul>
</nav>

		<div class="col-sm-6">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">Barrios</header>
				<div class="panel-body">
					{{ Form::open(array('url' => '/barrios/' . $barrio->id, 'class' => 'panel-body wrapper-lg')) }}
					{{ Form::hidden('_method', 'DELETE') }}

						<div class="form-group">
							<label>Barrio</label>

							<div class="form-control input-lg">
								{{ $barrio->barrio }}
							</div><br>

						{{ Form::submit('Eliminar', array('class' => 'btn btn-warning')) }}
						{{ Form::close() }}
				</div>
			</section>
		</div>
	</div>
<script src="/js/app.v2.js"></script>
@stop
