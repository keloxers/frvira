<?php

class VotosController extends BaseController {

	public function store($codigo,$mesa,$orden,$tvoto)
	{


		$procesado = true;

		// verifica si exite el codigo
		$elector = DB::table('electors')->where('codigo', '=', $codigo)->first();
		if ($elector) {
		} else {
			$procesado = false;
		}



		// verifica si ya esta cargada la matricula
		$voto = DB::table('votos')->where('orden', '=', $orden)->first();
		if ($voto) { $procesado = false; }

		if ($procesado) {
				// Actualiza la hora en la base de elector
				$elector = DB::table('electors')->where('matricula', '=', $orden)->first();
				if ($elector) {
					$elector_id = $elector->id;
					$elector = Elector::find($elector_id);
					$elector->dtimevotacion = $tvoto;
					$elector->save();
				}
		}

		$voto = new Voto;
		$voto->codigo = $codigo;
		$voto->mesa = $mesa;
		$voto->orden = $orden;
		$voto->tvoto = $tvoto;
		$voto->procesado = $procesado;
		$voto->save();


			$arr = array ('respuesta' => $procesado);

			return json_encode($arr);



	}

}
