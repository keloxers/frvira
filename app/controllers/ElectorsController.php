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

		$electors = DB::table('electors')->where('matricula', '=', $matricula)->get();

		// var_dump($elector);
		$title = "Electors";
		return View::make('electors.index', array('title' => $title, 'electors' => $electors));




	}


	public function grabarelector()
	{

		$electors_id = Input::get('electors_id');
		$barrios_id = Input::get('barrio');
		$categorias_id = Input::get('categoria');
		$puntero_id = Input::get('puntero_id');
		$apellido = Input::get('apellido');


		$elector = Elector::find($electors_id);

		$elector->barrios_id = $barrios_id;
		$elector->categorias_id = $categorias_id;
		$elector->puntero_id = $puntero_id;

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




	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('barrios.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
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

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$barrio = Barrio::find($id);

		// show the view and pass the nerd to it
		return View::make('barrios.show')
			->with('barrio', $barrio);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, $apellido='')
	{


		$electors = DB::table('electors')->where('id', '=', $id)->get();

		// var_dump($elector);
		$title = "Electors";
		return View::make('electors.index', array('title' => $title, 'electors' => $electors, 'apellido' => $apellido));





	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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


			$apellido = Input::get('apellido');


			$electors = DB::table('electors')->where('apellido', 'like', $apellido . '%')->paginate(3000);

			// var_dump($elector);
			$title = "Electors";
			return View::make('electors.show', array('title' => $title, 'electors' => $electors, 'apellido' => $apellido));




		}




}
