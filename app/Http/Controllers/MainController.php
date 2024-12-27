<?php

namespace App\Http\Controllers;

use App\Http\Requests\IbanRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreNewUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Requests\VerificaDisponibilitateCodRequest;
use App\Http\Resources\EcoCodesResource;
use App\Http\Resources\IbanCodesResource;
use App\Http\Resources\ListOfCitiesResource;
use App\Http\Resources\LocalitatiResource;
use App\Http\Resources\UsersResource;
use App\Models\EcoCodes;
use App\Models\Iban;
use App\Models\Localitati;
use App\Models\Raion;
use App\Models\Role;
use App\Models\User;
use App\Models\user_role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getUser(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        return response()->json([
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function getEditedUser($id)
    {
        $user = User::findOrFail($id);
        $users_raion = $user->raion;
        $raions = Raion::all();
        $user_imputernicire = $user->role;
        $imputerniciri = Role::all();
        return response()->json([
            'user' => new UsersResource($user),
            'user_raion' => $users_raion,
            'raions' => $raions,
            'user_imputernicire' => $user->role,
            'imputerniciri' => $imputerniciri,
        ]);
    }

    public function getAllUsers()
    {
        $allUsers = User::all();
        return UsersResource::collection($allUsers);
    }

    public function register(StoreUserRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try{
            $user = User::firstOrCreate($data);
            $token = auth()->tokenById($user->id);

            DB::commit();

            return response()->json([
                'access_token' => $token
            ]);
        } catch(\Exception $e){
            DB::rollBack();

            return response()->json([
                'message' => "Smth went wrong in registering the user!",
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function returnEcoRaionLocalitate()
    {
        $user = Auth::user();
        if ($user->raion_id) {
            $listOfCities = Raion::where('id', $user->raion_id)->get();
            $listOfLocalities = Localitati::where('raion_id', $user->raion_id)->get();
        } else {
            $listOfCities = Raion::all();
            $listOfLocalities = Localitati::where('raion_id', 1)->get();
        }

        //without eager method:
        $listOfEco = EcoCodes::all();

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

    public function updateLocalitati($raion_code)
    {
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
        } else {
            $listOfLocalities = collect();
        }
        return response()->json([
            'localities' => LocalitatiResource::collection($listOfLocalities),
        ]);
    }

    public function extractIban(IbanRequest $request)
    {
        $data = $request->validated();
        $ibanCode = Iban::where('codul_eco', $data['eco'])
            ->where('raion', $data['localitate'])
            ->whereRaw("iban_code LIKE ?", ["%{$data['localitate']}%"])
            ->first();

        if(!$ibanCode){
            return response()->json(['message'=>"Codul IBAN nu a fost gasit!"]);
        }
        return new IbanCodesResource($ibanCode);
    }


    public function deleteUser($id)
    {
        $userToDelete = User::findOrFail($id);
        DB::beginTransaction();
        try {
            $userToDelete->delete();

            DB::commit();
            return response()->json(['message' => 'User has been deleted successfully!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }

    public function editUser($id, UpdatePersonRequest $request)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

        $usersRole = $data['rol'];
        if ($data['rol'] === 1 || $data['rol'] === 2) {
            $data['raion_id'] = null;
        }
        unset($data['rol']);

        DB::beginTransaction();
        try{
            $user->update($data);
            $user->role()->sync($usersRole);

            DB::commit();
            return response()->json([
                'user' => $user,
                'raion_id' => $data['raion_id'],
            ]);
        } catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'message'=>$e->getMessage()
            ],500);
        }
    }

    public function getAllInfo()
    {
        $roluri = Role::all();
        $raioane = Raion::all();
        return response()->json([
            'roles' => $roluri,
            'raioane' => $raioane,
        ]);
    }

    public function storeNewUser(StoreNewUserRequest $request)
    {
        $data = $request->validated();
        $role = $data['role'];
        unset($data['role']);

        DB::beginTransaction();
        try{
            $user = User::firstOrCreate($data);
//        $user->role()->attach($role);
            //merge si cu attach, dar utilizam syncWithoutDetaching pt prevenirea duplicatelor!
            $user->role()->syncWithoutDetaching([$role]);

            DB::commit();
            return response()->json([
                'message' => 'Person has been successfully created!',
            ]);
        } catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'User creation failed!'], 500);
        }
    }

    public function verificaDisponibilitate(VerificaDisponibilitateCodRequest $request){
        $data = $request->validated();
        $exists = Iban::where('iban_code', $data['cod'])->exists();
        return $exists ?
            response()->json(['message'=>'Codul IBAN este deja ocupat'],200) :
            response()->json(['message'=>'Codul IBAN poate fi folosit'],200);
    }

    public function getAllIbans(SearchRequest $request){
        $query = Iban::query();
        if($request->has('search')){
//     se poate si  if($request->filled('search')){
            $search = $request->input('search');
            $query->where('iban_code', 'LIKE', '%' . $search .'%');
        }
        $ibans = $query->paginate(100);
//        $ibans = Iban::paginate(100);
        return response()->json([
            'ibans' => IbanCodesResource::collection($ibans)->response()->getData(true),
        ]);

    }

    public function getInfoForIbans(){
        $eco_codes = EcoCodes::all();
        $raions = Raion::all();
        $localitati = Localitati::all();
        return response()->json([
            'eco'=>$eco_codes,
            'raions'=>$raions,
            'localitati'=>$localitati,
        ]);
    }

    public function deleteIban($id){
        $iban_to_delete = Iban::findOrFail($id);

        DB::beginTransaction();
        try{
            $iban_to_delete->delete();
            DB::commit();
            return response()->json([
                'message'=>'The iban code has been successfully deleted!'
            ]);
        } catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'message'=>'Smth went wrong, contact the dev!'
            ]);
        }
    }
}
