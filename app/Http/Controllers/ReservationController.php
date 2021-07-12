<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Office;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
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
    public function index(Request $request)
    {
        $user = auth()->user();
        $request->flash();
        if($request->mode){
            switch ($request->mode) {
                case 'newReservations':
                    if($user->hasRole('admin')){
                        $reservations = Reservation::where('seen','0')->latest() ;
                    }else{
                        $reservations = Reservation::whereIn('pick_up_office_id',$user->offices->pluck('id'))->latest() ;
                    }
                break;
                case 'futureReservations':
                    if($user->hasRole('admin')){
                        $reservations = Reservation::where('reservation_pick_up_datetime','>',Carbon::now())->latest() ;
                    }else{
                        $reservations = Reservation::whereIn('pick_up_office_id',$user->offices->pluck('id'))->where('reservation_pick_up_datetime','>',Carbon::now())->latest() ;
                    }
                break;
                case 'previousReservations':
                    if($user->hasRole('admin')){
                        $reservations = Reservation::where('reservation_drop_off_datetime','<',Carbon::now())->latest() ;
                    }else{
                        $reservations = Reservation::whereIn('pick_up_office_id',$user->offices->pluck('id'))->where('reservation_drop_off_datetime','<',Carbon::now())->latest() ;
                    }
                break;
                default:
                    return back()->with("warning","Not filtered correctly");
                break;
            }
        }else{
            if($user->hasRole('admin')){
                $reservations = Reservation::latest() ;
            }else{
                $reservations = Reservation::whereIn('pick_up_office_id',$user->offices->pluck('id'))->latest() ;
            }
        }
        if($request->trackNumber){
            if($user->hasRole('admin')){
                $reservations = $reservations->where('trackNumber',$request->trackNumber)->latest() ;
            }else{
                $reservations = $reservations->whereIn('pick_up_office_id',$user->offices->pluck('id'))->where('trackNumber',$request->trackNumber)->latest() ;
            }
        }
        $reservations = $reservations->paginate();
        return view('reservation.index',compact(array_keys(get_defined_vars())));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        if(!auth()->user()){
            if(!auth()->user()->offices->contains($reservation)){
                return back()->with('error','You do not have permission to access this page');
            }
        }
        $reservation->seen = 1;
        $reservation->save();
        return view('reservation.edit',compact(array_keys(get_defined_vars())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        if($request->event){
            switch ($request->event) {
                case 'cancelReservation':
                    $request['status'] = 'canceled';
                    $request['canceled_at'] = Carbon::now();
                break;
                case 'costumerReceivedTheVehicle':
                    $request['pick_up_datetime'] = Carbon::now();
                    $office = Office::find($reservation->pick_up_office_id);
                    $vehicle = $office->vehicles()->find($reservation->vehicle_id);
                    $vehicle->pivot->qty -=1;
                    $vehicle->pivot->save();
                break;
                case 'costumerDeliveredTheVehicle':
                    $request['drop_off_datetime'] = Carbon::now();
                    $drop_off_office_id = $reservation->drop_off_office_id ? $reservation->drop_off_office_id : $reservation->pick_up_office_id;
                    $office = Office::find($drop_off_office_id);
                    $vehicle = $office->vehicles()->find($reservation->vehicle_id);
                    $vehicle->pivot->qty +=1;
                    $vehicle->pivot->save();
                break;
                default:
                return back()->with("warning","Not Sent correctly");
                break;
            }
        }

        $reservation->update($request->except(['_method','event']));
        return back()->with("success","Your transaction has been completed successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
            return back()->with("success","Your transaction has been completed successfully");
        } catch (Exception $e) {
            return back()->with("error","Something went wrong while processing your transaction. This may be because you tried to delete a record that cannot be deleted.");
        }
    }
}
