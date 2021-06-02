<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Office;
use App\Models\Vclass;
use App\Models\Vehicle;
use App\Models\Fueltype;
use App\Models\Geartype;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $offices = Office::all();
        return view('home.index',compact(array_keys(get_defined_vars())));
    }

    public function reservation(Request $request)
    {
        /* return dd(in_array('5',$request->vclass)); */
        $pick_up_office = Office::find($request->pick_up_office_id);
        $offices = Office::all();
        if(!$request->step){
            return redirect(route('home.reservation',['step'=>'reservation']));
        }
        if($request->step == 'vehicle'){
            $vclasses = Vclass::all();
            $geartypes = Geartype::all();
            $fueltypes = Fueltype::all();
            $vehicles = $pick_up_office->activeVehicles;
            if($request->vclass){
                $vehicles = $vehicles->whereIn('vclass_id',$request->vclass);
            }
            if($request->geartype){
                $vehicles = $vehicles->whereIn('geartype_id',$request->geartype);
            }
            if($request->fueltype){
                $vehicles = $vehicles->whereIn('fueltype_id',$request->fueltype);
            }
        }
        if($request->step == 'checkout'){
            $pick_up_office = Office::find($request->pick_up_office_id);
            $drop_off_office = Office::find($request->drop_off_office_id);
            $vehicle = $pick_up_office->activeVehicles()->find($request->vehicle_id);
        }
        return view('home.reservation',compact(array_keys(get_defined_vars())));
    }

}
