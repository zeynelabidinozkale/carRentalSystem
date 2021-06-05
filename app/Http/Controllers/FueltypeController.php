<?php

namespace App\Http\Controllers;

use App\Models\Fueltype;
use Illuminate\Http\Request;

class FueltypeController extends Controller
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
        $fueltypes =  Fueltype::latest()->paginate(20);
        return view('fueltype.index',compact(array_keys(get_defined_vars())));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('fueltype.create',compact(array_keys(get_defined_vars())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Fueltype::create($request->except('_method'));
        return redirect(route('fueltype.index',['page'=>\Session::get('page_number')]))->with("success","Your transaction has been completed successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fueltype  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function show(Fueltype $fueltype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fueltype  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function edit(Fueltype $fueltype, Request $request)
    {
        return view('fueltype.edit',compact(array_keys(get_defined_vars())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fueltype  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fueltype $fueltype)
    {
        $fueltype->update($request->except(['_method']));
        return redirect(route('fueltype.index',['page'=>\Session::get('page_number')]))->with("success","Your transaction has been completed successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fueltype  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fueltype $fueltype)
    {
        $fueltype->delete();
        return back()->with("success","Your transaction has been completed successfully");
    }
}
