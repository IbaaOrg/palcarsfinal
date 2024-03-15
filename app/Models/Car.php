<?php

namespace App\Models;

use App\Models\User;
use App\Models\Color;
use App\Models\CarImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;
    protected $fillable=['car_number','make','model','catrgory','description','year','seats','doors','bags','fuel_full','fuel_type','steering','user_id','color_id','price_id'];
    //company that add car
    public function ownerUser(){
        return $this->belongsTo(User::class);
    }
    //user that rent a car
    public function renter(){
        return $this->belongsTo(User::class);
    }
    public function carImages(){
        return $this->hasMany(CarImage::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

}
