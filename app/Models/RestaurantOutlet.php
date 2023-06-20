<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantOutlet extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function menu(){
        return $this->hasMany('App\Menu');
    }
}
