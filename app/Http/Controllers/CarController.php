<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

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
