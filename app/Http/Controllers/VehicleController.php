<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Vclass;
use App\Models\Vehicle;
use App\Models\Fueltype;
use App\Models\Geartype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles =  Vehicle::latest()->paginate(20);
        return view('vehicle.index',compact(array_keys(get_defined_vars())));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vclasses = Vclass::all();
        $fueltypes = Fueltype::all();
        $geartypes = Geartype::all();

        return view('vehicle.create',compact(array_keys(get_defined_vars())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->except(['_method','image']));
        if($request->image){
            $imageName = time().'.'.$request->image->extension();
            $request->image = $request->file('image')->store('vehicles/img','public',$imageName);
            $vehicle->image = $request->image;
            $vehicle->save();
        }
        return redirect(route('vehicle.index',['page'=>\Session::get('page_number')]))->with("success","Your transaction has been completed successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $vclasses = Vclass::all();
        $fueltypes = Fueltype::all();
        $geartypes = Geartype::all();
        return view('vehicle.edit',compact(array_keys(get_defined_vars())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle->update($request->except(['_method','image','imageUrl']));
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            if(Storage::exists($vehicle->image)){
                unlink('.'.Storage::url($vehicle->image));
            }
            $vehicle->image = $request->file('image')->store('vehicles/img','public',$imageName);

        }else{
            $vehicle->image = $request->imageUrl;
        }
        $vehicle->save();
        return redirect(route('vehicle.index',['page'=>\Session::get('page_number')]))->with("success","Your transaction has been completed successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            unlink('.'.Storage::url($vehicle->image));
            $vehicle->delete();
            return back()->with("success","Your transaction has been completed successfully");
        } catch (Exception $e) {
            return back()->with("error","Something went wrong while processing your transaction. This may be because you tried to delete a record that cannot be deleted.");
        }
    }
}
