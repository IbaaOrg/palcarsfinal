<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ResponseTrait;
    public function index(Request $request)
    {
        //
        $user=Auth::user();
        if ($user) {
            // User is authenticated
            return response()->json(['user' => $user], 200);
        } else {
            // User is not authenticated
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator=Validator::make($request->all(), [
            'car_number'=> 'required|unique:cars,car_number|regex:/^[A-Z]{1,2}-[0-9]{4,5}-[A-Z]{1}$/u',
            'make'=>'required|string|max:255',
            'model'=>'nullable|string|max:255',
            'catrgory'=>'required|string|in:SUV,Hatchback,Sedan,Convertible,Crossover,Station Wagon,Minivan,Pickup trucks',
            'description'=>'nullable|string',
            'year'=>'required|integer|digits:4|min:1900|max:' . date('Y'),
            'seats'=>'required|integer|min:1|max:10',
            'doors'=>'required|string|in:2,3,4',
            'bags'=>'nullable|integer|min:1|max:8',
            'fuel_full'=>$request->fuel_type==='electricity'?'nullable|numeric|min:0|max:1000':'required|numeric|min:0|max:1000', 
            'fuel_type'=>'required|string|in:gas,diesel,electricity',
            'steering'=>'required|string|in:Automatic,Manual',
        ]);
        if($validator->fails()){
            $msg = $validator->errors()->first();
            return $this->fail($msg, '400');
        }
        $data=['car_number'=>$request->car_number,
        'make'=>$request->make,];
        $request->model!==null??$data['model']=$request->model;
        $data['catrgory']=$request->catrgory;
        $data['year']=$request->year;
        $data['seats']=$request->seats;
        $data['doors']=$request->doors;
        $request->has('description')!==null??$data['description']=$request->description;
        $request->has('bags')!==null??$data['bags']=$request->bags;
        $request->has('fuel_full')!==null??$data['fuel_full']=$request->fuel_full; 
        $data['fuel_type']=$request->fuel_type;
        $data['steering']=$request->steering;
        $data['user_id']=$request->user()->id;
        $data['color_id']=$request->color_id;
        $data['price_id']=$request->price_id;

        $car=Car::create($data);
        return $this->success($car);
    

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
