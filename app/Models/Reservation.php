<?php

namespace App\Models;

use App\Models\User;
use App\Models\Office;
use App\Models\Vehicle;
use App\Models\BillingInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client(){
        return $this->belongsTo(User::class,'client_id');
    }
    public function personnel(){
        return $this->belongsTo(User::class,'personnel_id');
    }
    public function dropOffOffice(){
        return $this->belongsTo(User::class,'drop_off_office_id');
    }
    public function pickUpOffice(){
        return $this->belongsTo(Office::class,'pick_up_office_id');
    }
    public function billingInformation(){
        return $this->hasOne(BillingInformation::class);
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

}
