<?php

class ElectorsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        // $electors = DB::table('electors')->paginate(30);
				$electors = null;
        $title = "Electors";
        return View::make('electors.index', array('title' => $title, 'electors' => $electors));
	}

	public function buscar()
	{


		$matricula = Input::get('matricula');
		$apellido = '';

		$electors = DB::table('electors')->where('matricula', '=', $matricula)->get();

		// var_dump($elector);
		$title = "Electors";
		return View::make('electors.index', array('title' => $title, 'electors' => $electors, 'apellido' => $apellido));




	}


	public function grabarelector()
	{

		$electors_id = Input::get('electors_id');
		$barrios_id = Input::get('barrio');
		$categorias_id = Input::get('categoria');
		$puntero_id = Input::get('puntero_id');
		$apellido = Input::get('apellido');
		$dtimeirbuscar = Input::get('dtimeirbuscar');

		$elector = Elector::find($electors_id);

		$elector->barrios_id = $barrios_id;
		$elector->categorias_id = $categorias_id;
		$elector->puntero_id = $puntero_id;
		$elector->dtimeirbuscar = $dtimeirbuscar;


		$elector->save();


		$electors = DB::table('electors')->where('apellido', 'like', $apellido . '%')->paginate(3000);

		// var_dump($elector);
		$title = "Electors";
		return View::make('electors.show', array('title' => $title, 'electors' => $electors, 'apellido' => $apellido));


	}





		public function importarpadron()
		{
			$padprovs = DB::table('PADPROV')->where('LEYCIR', 'like', '%' . 'VIRASORO' . '%')->get();
			$i = 0;
			foreach ($padprovs as $padprov) {

				$i++;
				// echo "ID: " . $i . " ";

				$elector = DB::table('electors')->where('matricula', '=', $padprov->MATRICULA)->get();

				if (count($elector) > 0 ) {

					// echo "Matricula: " . $padprov->MATRICULA . " YA EXISTE.<br>";

				} else {

					echo "Agregando Matricula $padprov->MATRICULA <br>";

				$elector = new Elector;

				$elector->matricula = $padprov->MATRICULA;
				$elector->clase = $padprov->CLASE;
				$elector->apellido = $padprov->APELLIDO;
				$elector->nombre = $padprov->NOMBRE;
				$elector->domicilio = $padprov->DOMICILIO;
				$elector->tipodocumento = $padprov->TIPODOC;
				$elector->sexo = $padprov->SEXO;
				$elector->mesa = 0;
				$elector->ordemn = 0;
				$elector->barrios_id = 1;

				$elector->save();
				}
			}
			die;
			return Redirect::to('/');
		}

	public function create()
	{
        return View::make('barrios.create');
	}

	public function store()
	{
		$rules = [
			'barrio' => 'required|unique:barrios'
		];
		if (! Barrio::isValid(Input::all(),$rules)) {
			return Redirect::back()->withInput()->withErrors(Barrio::$errors);
		}
		$barrio = new Barrio;
		$barrio->barrio = Input::get('barrio');
		$barrio->save();
		return Redirect::to('/barrios');
	}

	public function show($id)
	{

		$barrio = Barrio::find($id);
		return View::make('barrios.show')
			->with('barrio', $barrio);
	}

	public function edit($id, $apellido='')
	{
		$electors = DB::table('electors')->where('id', '=', $id)->get();
		$title = "Electors";
		return View::make('electors.index', array('title' => $title, 'electors' => $electors, 'apellido' => $apellido));
	}


	public function update($id)
	{
		$barrio = Barrio::find($id);
		$rules = [
				'barrio' => 'required|unique:barrios,barrio,' . $id,
		];
		if (! Barrio::isValid(Input::all(),$rules)) {
			return Redirect::back()->withInput()->withErrors(Barrio::$errors);
		}
		$barrio->barrio = Input::get('barrio');
		$barrio->save();
		return Redirect::to('/barrios');
	}


	public function destroy($id)
	{
		$input = Input::all();
		$barrio = Barrio::find($id)->delete();
		return Redirect::to('/barrios');
	}

   public function search(){
        $term = Input::get('term');
        $ciudads = DB::table('barrios')->where('barrio', 'like', '%' . $term . '%')->get();
        $adevol = array();
        if (count($barrios) > 0) {

            foreach ($barrios as $barrio)
                {
                    $adevol[] = array(
                        'id' => $barrio->id,
                        'value' => $barrio->barrio,
                    );
            }
        } else {
                    $adevol[] = array(
                        'id' => 0,
                        'value' => 'no hay coincidencias para ' .  $term
                    );
        }
        return json_encode($adevol);
    }


		public function listarshow()
		{
			$apellido = Input::get('apellido', null);

			if ($apellido == null) {
				$electors = null;
			} else {
				$electors = DB::table('electors')->where('apellido', 'like', $apellido . '%')->paginate(3000);
			}

			$title = "Electors";
			return View::make('electors.show', array('title' => $title, 'electors' => $electors, 'apellido' => $apellido));
		}







				public function electoresporbarrios()
				{
					$barrios = DB::table('barrios')->orderby('barrio')->get();
					$title = 'Seleccione un barrio';
					return View::make('electors.showporbarrio', array('title' => $title, 'barrios' => $barrios));
				}




				public function electoresporpunteros()
				{
					$punteros = DB::table('electors')->where('categorias_id', '=', 2)->get();
					$title = 'Seleccione un puntero';
					return View::make('electors.showporpuntero', array('title' => $title, 'punteros' => $punteros));
				}

				public function informevotantes($id, $tabla, $opcion)
				{

					$electores = DB::table('electors');

					if ($tabla=='barrios') {
						$electores = $electores->where('barrios_id', '=', $id);
						$title = 'Electores por barrio ';
					} else {
						$electores = $electores->where('puntero_id', '=', $id);
						$title = 'Electores por punteros ';
					}

					if ($opcion=='votaron') {
						$electores = $electores->where('dtimevotacion', '<>', '0000-00-00 00:00:00');
						$title += 'ya votaron';
					}

					if ($opcion=='faltanvotaron') {
						$electores = $electores->where('dtimevotacion', '=', '0000-00-00 00:00:00');
						$title += 'faltan votar';
					}

					$electores = $electores->get();



					return View::make('electors.showvotantes', array('title' => $title, 'electors' => $electores, 'apellido' => ''));
				}



				public function voto($id)
				{
					// echo "llegue aca";

					$elector = Elector::find($id);

					if ($elector->dtimevotacion=="00:00:00") {
							$elector->dtimevotacion = date("H:i:s");
					} else {
						$elector->dtimevotacion = "00:00:00";
					}

					$elector->save();

					$electors = DB::table('electors')->where('id', '=', $id)->get();

					$title = "Electors";
					return View::make('electors.index', array('title' => $title, 'electors' => $electors, 'apellido' => $elector->apellido));
				}

				public function servicejson($tabla, $id)
				{


					$electores = DB::table('electors');

					if ($tabla=='barrios') {
						$electores = $electores->where('barrios_id', '=', $id);
					} else {
						$electores = $electores->where('puntero_id', '=', $id);
					}

					$electores = $electores->where('dtimevotacion', '=', '0000-00-00 00:00:00');
					
					$electores = $electores->get();


					$adevol = array();

					if (count($electores) > 0) {

							foreach ($electores as $elector)
									{

											$adevol[] = array(
													'clase' => $elector->clase,
													'matricula' => $elector->matricula,
													'apellido' => $elector->apellido,
													'nombre' => $elector->nombre,
													'domicilio' => $elector->domicilio,
											);
							}
					} else {
											$adevol[] = array(
													'clase' => '',
													'matricula' => 'no hay coincidencias para: ' .  $term,
													'apellido' => '',
													'nombre' => '',
													'direccion' => '',
											);
					}

					return json_encode($adevol);




				}



}
