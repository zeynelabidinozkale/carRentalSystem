<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\SendUserRegistered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        if($request->email != $user->email){
            $password = rand(100000,999999);
            $request['password'] = Hash::make($password);
            Mail::to($request->email)->send(new SendUserRegistered($request->email,$password));
        }
        $user->update($request->except('_token'));
        return back()->with('success','your information has been successfully updated');
    }
    public function passwordChange(Request $request){
        $user = auth()->user();
        if(isset($request->password['currentPassword']) && isset($request->password['newPassword']) && isset($request->password['confirmNewPassword'])){
            if(!Hash::check($request->password['currentPassword'],$user->password)){
                return back()->with("error","You entered your password incorrectly.");
            }
            if($request->password['newPassword'] != $request->password['confirmNewPassword']){
                return back()->with("error","The passwords you enter are different.");
            }
            $user->password = Hash::make($request->password['newPassword']);
            $user->save();
            return back()->with("success","Your transaction has been completed successfully.");
        }
    }
    public function reservations(){
        return view('account.reservations');
    }
    public function reservationDetails(Request $request){
        $reservation = auth()->user()->reservations()->findOrFail($request->id);
        return view('account.reservationDetails',compact("reservation"));
    }
}
