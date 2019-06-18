<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class CarController extends Controller
{
	public function index() {
		$years = \DB::table('Cars')->distinct()->select('Year')->orderBy('Year', 'ASC')->get();
		$makers = \DB::table('Cars')->distinct()->select('Make')->orderBy('Make', 'ASC')->get();
		$models = \DB::table('Cars')->distinct()->select('Model')->orderBy('Model', 'ASC')->get();
		$trims =  \DB::table('Cars')->distinct()->select('Trim')->orderBy('Trim', 'ASC')->get();
		
		$years = json_decode($years, true);
		$makers = json_decode($makers, true);
		$models = json_decode($models, true);
		$trims = json_decode($trims, true);
		return view('welcome', [
            'years' => $years,
			'makers' => $makers,
			'models' => $models,
			'trims' => $trims,
        ]);
	}
}
