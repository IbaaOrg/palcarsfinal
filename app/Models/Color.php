<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['color'];
    public function cars()
{
    return $this->belongsToMany(Car::class);
}
}
