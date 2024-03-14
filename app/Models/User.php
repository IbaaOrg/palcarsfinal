<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Car;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo_user',
        'photo_drivinglicense',
        'birthdate',
        'description',
        'role'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function isAdmin(){
        return $this->role=="Admin";
    }
    public function isRenter(){
        return $this->role=="Renter";
    }
    public function isCompany(){
        return $this->role=="Company";
    }
    //cars for company
    public function cars(){
        return $this->hasMany(Car::class);
    }
    //rented car 
    public function rentedCar(){
        return $this->hasOne(Car::class);
    }
    // //all rentals
    // public function rentals()
    // {
    //     return $this->hasMany(Rental::class);
    // }
}
