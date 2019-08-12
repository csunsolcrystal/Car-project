<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class CarController extends Controller
{
	public function index() {
		$url = "https://www.carqueryapi.com/api/0.3/?cmd=getYears";
		$data = file_get_contents($url);
		$years = json_decode($data, true);
		return view('welcome', [
            'years' => $years['Years'],
        ]);
	}
	public function getYears() {
		//$years = \DB::table('Cars')->distinct()->select('Year')->orderBy('Year', 'ASC')->get();
		$url = "https://www.carqueryapi.com/api/0.3/?cmd=getYears";
		$data = file_get_contents($url);
		$years = json_decode($data, true);
		$years = $years['Years'];
		$totalyears = [];
		for($i = $years['min_year'], $size = $years['max_year']; $i <= $size; $i++)
			$totalyears[] = $i;
        return response()->json($totalyears);
	}
	public function getMakers($request) {
		//$makers = \DB::table('Cars')->distinct()->select('Make')->where('Year', $request)->orderBy('Make', 'ASC')->get();
		$url = urldecode("https://www.carqueryapi.com/api/0.3/?cmd=getMakes&year=" . urlencode($request) . "&sold_in_us=1");
		$data = file_get_contents($url);
		$makers = json_decode($data, true);
		$makers = $makers['Makes'];
        return response()->json($makers);
	}
	public function getModels($request, $request2) {
		//$models = \DB::table('Cars')->distinct()->select('Model')->where('Year', $request)->where('Make', $request2)->orderBy('Model', 'ASC')->get();
		$url = "https://www.carqueryapi.com/api/0.3/?cmd=getModels&make=" . urlencode($request2) . "&year=". urlencode($request) ."&sold_in_us=1";
		$data = file_get_contents($url);
		$models = json_decode($data, true);
		$models = $models['Models'];
        return response()->json($models);
	}
	public function getTrims($request, $request2, $request3) {
		//$trims = \DB::table('Cars')->distinct()->select('Trim')->where('Year', $request)->where('Make', $request2)->where('Model', $request3)->orderBy('Trim', 'ASC')->get();
		//https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getTrims&[params]
		$url = "https://www.carqueryapi.com/api/0.3/?cmd=getTrims&year=" . urlencode($request) . "&make=". urlencode($request2) . "&model=". urlencode($request3) . "&sold_in_us=1";
		$data = file_get_contents($url);
		$trims = json_decode($data, true);
		$trims = $trims['Trims'];
        return response()->json($trims);
	}
	public function calculateVinyl($request4) {
		// get length of car
		//$length = \DB::table('Cars')->distinct()->select('Length_in')->where('Year', $request)->where('Make', $request2)->where('Model', $request3)->where('Trim', $request4)->first();
		$url = "https://www.carqueryapi.com/api/0.3/?cmd=getModel&model=".urlencode($request4);
		$data = file_get_contents($url);
		$length = json_decode($data, true);
		$length = $length[0]['model_length_in'];
		if($length == null) {
			$vinyl = ["Not Available", "Not Available", "Not Available"];
			return response()->json($vinyl);
		}
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
			 $data = Car::search($searchquery)->limit(5)->get();

			 return response()->json($data);
	 }

}
