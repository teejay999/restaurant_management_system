<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Restaurant;
use App\Models\RestaurantOutlet;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function restuarant(){
        return $this->hasMany('App\Restaurant');
    }
    public function restaurantOutlet(){
        return $this->hasMany('App\RestaurantOutlet');
    }
    public function user(){
        return $this->hasMany('App\User');
    }

}
