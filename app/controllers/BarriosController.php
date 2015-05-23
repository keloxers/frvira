<?php

class BarriosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $barrios = DB::table('barrios')->paginate(30);
        $title = "Barrios";
        return View::make('barrios.index', array('title' => $title, 'barrios' => $barrios));
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
	public function edit($id)
	{
		$barrio = Barrio::find($id);
		$title = "Editar Barrio";

        return View::make('barrios.edit', array('title' => $title, 'barrio' => $barrio));
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


}
