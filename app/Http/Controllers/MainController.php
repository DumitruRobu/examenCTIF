<?php

namespace App\Http\Controllers;
use App\Http\Requests\IbanRequest;
use App\Http\Resources\EcoCodesResource;
use App\Http\Resources\ListOfCitiesResource;
use App\Http\Resources\LocalitatiResource;
use App\Models\EcoCodes;
use App\Models\Iban;
use App\Models\Localitati;
use App\Models\Raion;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function returnEcoRaionLocalitate(){
        //without eager method:
        $listOfEco = EcoCodes::all();
        $listOfCities = Raion::all();
        $listOfLocalities = Localitati::where('raion_id', 1)->get();

        return response()->json([
            'eco_codes' => EcoCodesResource::collection($listOfEco),
            'cities' => ListOfCitiesResource::collection($listOfCities),
            'localities' => LocalitatiResource::collection($listOfLocalities),
        ]);

        //Folsim eager loading method:
//        $listOfEco = EcoCodes::all();
//        $listOfCities = Raion::with('localitati')->get();
//
//        return response()->json([
//            'eco_codes' => EcoCodesResource::collection($listOfEco),
//            'cities' => ListOfCitiesResource::collection($listOfCities),
//            'localities' => LocalitatiResource::collection($listOfCities->first()?->localitati ?? collect()),
//        ]);
    }

    public function updateLocalitati($raion_code){
        //fara magic method
//        $raion_id = Raion::where('code', $raion_code)->value('id');
//        $listOfLocalities = Localitati::where('raion_id', $raion_id)->get();
//        return response()->json([
//            'localities' => LocalitatiResource::collection($listOfLocalities),
//        ]);

        //cu magic method
        $raion = Raion::where('code', $raion_code)->first();
        if ($raion) {
            $listOfLocalities = $raion->localitati;
        }else {
            $listOfLocalities = collect();
        }
        return response()->json([
            'localities'=>LocalitatiResource::collection($listOfLocalities),
        ]);
    }

    public function extractIban(IbanRequest $request){
        $data = $request->validated();
        $ibanCode = Iban::where('codul_eco', $data['eco'])
            ->where('raion', $data['localitate'])
            ->whereRaw("iban_code LIKE ?", ["%{$data['localitate']}%"])
            ->first();
        return $ibanCode;
    }
}
