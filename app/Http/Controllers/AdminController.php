<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('admin')){
            $reservations = Reservation::where('seen','0')->latest()->get();
        }else{
            $reservations = Reservation::whereIn('pick_up_office_id',$user->offices->pluck('id'))->latest()->get();
        }
        return view('admin.dashboard',compact(array_keys(get_defined_vars())));
    }

    public function logs(){
        if(!auth()->user()->hasRole('admin')){
            return back()->with('error','You dont have the permission to access this page');
        }
        $logs = DB::select('Call get_logs()');
        return view('admin.logs',compact(array_keys(get_defined_vars())));
    }
}
