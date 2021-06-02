<?php

namespace App\Models;

use App\Models\Vclass;
use App\Models\Fueltype;
use App\Models\Geartype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function offices(){
        return $this->belongsToMany(Office::class,'office_vehicle')->withPivot('deposit','cost','qty','active');
    }

    public function vclass(){
        return $this->belongsTo(Vclass::class);
    }
    public function geartype(){
        return $this->belongsTo(Geartype::class);
    }
    public function fueltype(){
        return $this->belongsTo(Fueltype::class);
    }
}
