<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class CarController extends Controller
{
	public function index() {
		$years = \DB::table('Cars')->distinct()->select('Year')->orderBy('Year', 'ASC')->get();

		$years = json_decode($years, true);
		return view('welcome', [
            'years' => $years,
        ]);
	}
	public function getYears($request) {
		$years = \DB::table('Cars')->distinct()->select('Year')->orderBy('Year', 'ASC')->get();
        return response()->json($years);
	}
	public function getMakers($request) {
		$makers = \DB::table('Cars')->distinct()->select('Make')->where('Year', $request)->orderBy('Make', 'ASC')->get();
        return response()->json($makers);
	}
	public function getModels($request, $request2) {
		$models = \DB::table('Cars')->distinct()->select('Model')->where('Year', $request)->where('Make', $request2)->orderBy('Model', 'ASC')->get();
        return response()->json($models);
	}
	public function getTrims($request, $request2, $request3) {
		$trims = \DB::table('Cars')->distinct()->select('Trim')->where('Year', $request)->where('Make', $request2)->where('Model', $request3)->orderBy('Trim', 'ASC')->get();
        return response()->json($trims);
	}
	public function calculateVinyl($request, $request2, $request3, $request4) {
		// get length of car
		$length = \DB::table('Cars')->distinct()->select('Length_in')->where('Year', $request)->where('Make', $request2)->where('Model', $request3)->where('Trim', $request4)->first();
		$length = $length->Length_in;
		$vinyl = [];
		$basic = 20;
		$medium = 15;
		$expert = 10;

		// formulas
		$vinyl[] = ceil((($length * 3) / 12) + $basic);
		$vinyl[] = ceil((($length * 3) / 12) + $medium);
		$vinyl[] = ceil((($length * 3) / 12) + $expert);

		return response()->json($vinyl);
	}
	public function autocompleteSearch(Request $request) {
			 $searchquery = $request->searchquery;
			 $data = \DB::table('Cars')->Select('Year', 'Make', 'Model', 'Trim')->where('Model','like','%'.$searchquery.'%')->get();

			 return response()->json($data);
	 }

}
