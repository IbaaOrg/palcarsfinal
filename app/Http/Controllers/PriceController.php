<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;

class PriceController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
     $price=Price::all();
     return $this->success($price);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $price=Price::create([
            'price'=>$request->price,
        ]);
        return $this->success($price);
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
