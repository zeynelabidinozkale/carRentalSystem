<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function personnels(){
        return $this->belongsToMany(User::class,'office_personnel');
    }
    public function vehicles(){
        return $this->belongsToMany(Vehicle::class,'office_vehicle')->withPivot('deposit','cost','active');
    }
    public function activeVehicles(){
        return $this->vehicles()->wherePivot('active','1');
    }
}
