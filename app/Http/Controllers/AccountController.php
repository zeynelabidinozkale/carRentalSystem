<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();
        return view('account.index',compact('user'));
    }
    public function update(Request $request){
        $user = auth()->user();
        $user->update($request->except('_token'));
        return back()->with('success','your information has been successfully updated');
    }
    public function reservations(){
        return view('account.reservations');
    }
    public function reservationDetails(Request $request){
        $reservation = auth()->user()->reservations()->findOrFail($request->id);
        return view('account.reservationDetails',compact("reservation"));
    }
}
