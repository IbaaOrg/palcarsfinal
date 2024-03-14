<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->success(Color::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'color'=>'unique:colors',
        ],[
            'color.unique'=>'the color have been already exist'
        ]);
        if($validator->fails()){
            $msg=$validator->errors()->first();
            return $this->Fail($msg, '404');
        }
        //
        $color=Color::create([
            'color'=>$request->color,
        ]);
        return $this->success($color);
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
        $validator = Validator::make($request->all(), [
            'color' => 'required', 
        ]);
        
        if ($validator->fails()) {
            return $this->fail($validator->errors()->first(), 400); 
        }
        //
        $color=Color::find($id);
        if($color){
        $color->update(['color'=>$request->color]);
        return $this->success($color);
        }
        return $this->fail("color doesn't exist",401);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $color=Color::find($id);
        if($color){
        if( $color->delete())
        return $this->success('Done');
        return $this->fail('error while deleteing',400);
    }
    return $this->fail("color doesn't exist",401);

    }
}
