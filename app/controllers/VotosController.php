<?php

class VotosController extends BaseController {

	public function store($codigo,$mesa,$orden,$tvoto)
	{
		// $rules = [
		// 	'mesa' => 'required|unique:barrios',
		// 	'orden' => 'required|unique:barrios'
		// ];
		// if (! Voto::isValid(Input::all(),$rules)) {
		// 	return Redirect::back()->withInput()->withErrors(Barrio::$errors);
		// }

		$voto = new Voto;
		$voto->codigo = $codigo;
		$voto->mesa = $mesa;
		$voto->orden = $orden;
		$voto->tvoto = $tvoto;
		$voto->save();
		echo "ok";
		return;
	}




}
