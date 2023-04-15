<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = ['name'];


    public function subLocations()
    {
        return $this->hasMany('App\Models\SubLocations', 'location_id', 'id');


    }
}
