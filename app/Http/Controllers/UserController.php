<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    use ResponseTrait;
  
    public function register(Request $request){
      

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            'phone' => 'required|numeric|regex:/^05[0-9]{8}$/',
            'photo_user' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'photo_drivinglicense' => 'required|image|mimes:jpeg,png,jpg,gif',
            'birthdate' => 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'description' => 'nullable',
            'role' => 'required|in:Admin,Renter,Company',
        ], [
            'password.required'=>'password must contain at least one uppercase letter and one lowercase letter and one special character to register.',
            'birthdate.before_or_equal' => 'You must be 18 years old or older to register.',
        ]);
    
        if ($validator->fails()) {
            $msg = $validator->errors()->first();
            return $this->Fail($msg, '404');
        }
    
        // Process photo_user
        if ($request->hasFile('photo_user')) {
            $file_user = $request->file('photo_user');
            $fileName_user = "UserIMG_" . rand(1000, 9999) . "." . $file_user->getClientOriginalExtension();
            $path_user = $file_user->storeAs('images/users', $fileName_user, 'public');
            $photo_user = Storage::url($path_user);
        } else {
            // Set default photo_user if no image is uploaded
            $photo_user = Storage::url('images/users/user.png');
        }
    
        // Process photo_drivinglicense
        $file_drivinglicense = $request->file('photo_drivinglicense');
        $fileName_drivinglicense = "DrivinglicenseIMG_" . rand(1000, 9999) . "." . $file_drivinglicense->getClientOriginalExtension();
        $path_drivinglicense = $file_drivinglicense->storeAs('images/users', $fileName_drivinglicense, 'public');
        $photo_drivinglicense = Storage::url($path_drivinglicense);
    
    
        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'photo_user' => $photo_user,
            'photo_drivinglicense' => $photo_drivinglicense,
            'birthdate' => $request->birthdate,
            'description' => $request->description,
            'role' => $request->role,
        ]);
        $user->photo_user=url($user->photo_user);
        $user->photo_drivinglicense=url($user->photo_drivinglicense);
        return $this->Success($user);

    }
    public function login(Request $request){
        $email=$request->email;
        $password=$request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            $user=Auth::user();
            return $this->success($user);
        }

        return $this->fail( 'Invalid email or password.',403);
        
    }
    public function logout(){
         Auth::logout();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return User::all();
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
