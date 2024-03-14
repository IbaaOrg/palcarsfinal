<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Resources\AllUserResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UpdateUserResource;

class UserController extends Controller
{
    
    use ResponseTrait;
  
    public function register(Request $request){
      

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|min:3|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            'phone' => 'required|numeric|regex:/^05[0-9]{8}$/',
            'photo_user' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'photo_drivinglicense' => $request->role === 'Renter'?'required|image|mimes:jpeg,png,jpg,gif':'nullable|image|mimes:jpeg,png,jpg,gif',
            'birthdate' => $request->role === 'Renter' ? 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d') : 'nullable|date|before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'description' => 'nullable',
            'role' => 'required|in:Admin,Renter,Company',
        ], [
            'name.regex'=>'your name can only contain letters',
            'password.regex'=>'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'phone.regex'=>'The phone number must contain 10 digits start with (05)',
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
        if ($request->hasFile('photo_drivinglicense')) {
            $file_drivinglicense = $request->file('photo_drivinglicense');
            $fileName_drivinglicense = "DrivinglicenseIMG_" . rand(1000, 9999) . "." . $file_drivinglicense->getClientOriginalExtension();
            $path_drivinglicense = $file_drivinglicense->storeAs('images/users', $fileName_drivinglicense, 'public');
            $photo_drivinglicense = Storage::url($path_drivinglicense);
        } else {
            // Set default photo_user if no image is uploaded
            $photo_drivinglicense = null;
        }
       
    
    
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
        $token=$user->createToken("TokenUser")->plainTextToken;
        $user->token=$token;
      
        return $this->Success(new UserResource($user));

    }
    public function login(Request $request){
        $email=$request->email;
        $password=$request->password;
        
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            $user=Auth::user();
            $token=$user->createToken("TokenUser")->plainTextToken;
            $user->token=$token; 
            return $this->success(new AuthResource($user));
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
        return $this->success(AllUserResource::collection(User::all()));
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
        return $this->success(new AllUserResource(User::find($id)));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->fail('User not found', 404);
        }
    
       
    
        // Prepare data for update
        $data = [
            'name' => $request->input('name', $user->name),
            'email' => $request->input('email', $user->email),
            'phone' => $request->input('phone', $user->phone),
            'birthdate' => $request->input('birthdate', $user->birthdate),
            'active' => $request->input('active', $user->active), // Only set if the logged-in user is an admin
        ];
    
        // Process photo_user
        if ($request->hasFile('photo_user')) {
            $file_user = $request->file('photo_user');
            $fileName_user = "UserIMG_" . rand(1000, 9999) . "." . $file_user->getClientOriginalExtension();
            $path_user = $file_user->storeAs('images/users', $fileName_user, 'public');
            $data['photo_user'] = Storage::url($path_user);
    
            // Delete old photo_user
            if ($user->photo_user) {
                $oldPhotoPath = public_path($user->photo_user);
                if (File::exists($oldPhotoPath)) {
                    File::delete($oldPhotoPath);
                }
            }
        }
    
        // Process photo_drivinglicense
        if ($request->hasFile('photo_drivinglicense')) {
            $file_drivinglicense = $request->file('photo_drivinglicense');
            $fileName_drivinglicense = "DrivinglicenseIMG_" . rand(1000, 9999) . "." . $file_drivinglicense->getClientOriginalExtension();
            $path_drivinglicense = $file_drivinglicense->storeAs('images/users', $fileName_drivinglicense, 'public');
            $data['photo_drivinglicense'] = Storage::url($path_drivinglicense);
    
            // Delete old photo_drivinglicense if exists
            if ($user->photo_drivinglicense) {
                $oldPhotoPath = public_path($user->photo_drivinglicense);
                if (File::exists($oldPhotoPath)) {
                    File::delete($oldPhotoPath);
                }
            }
        }
    
        // Update user data
        $user->update($data);
    
        return $this->success($user);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    $user=User::find($id);
    if($user){
    $user->delete();
    return $this->success("successfully deleted");
    }
return $this->fail('user not found',404);

    }
}
