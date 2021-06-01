<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class OfficeController extends Controller
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
        $offices =  Office::latest()->paginate(20);
        return view('office.index',compact(array_keys(get_defined_vars())));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('office.create',compact(array_keys(get_defined_vars())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $office = Office::create($request->except(['_method','vehicles']));
        $office->vehicles()->sync($request->vehicles);
        return redirect(route('office.index',['page'=>\Session::get('page_number')]))->with("success","İşleminiz Başarıyla Tamamlandı");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        $vehicles = Vehicle::all();
        return view('office.edit',compact(array_keys(get_defined_vars())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $office->update($request->except(['_method','vehicle','redirect']));
        $office->vehicles()->detach();
        $office->vehicles()->sync($request->vehicle);
        switch ($request->redirect) {
            case 'saveAndGoBack':
                return redirect(route('office.index',['page'=>\Session::get('page_number')]))->with("success","İşleminiz Başarıyla Tamamlandı");
            break;
            case 'saveAndStayOnThisPage':
                return back()->with("success","Your transaction has been completed successfully.");
            break;
            default:
                abort(404);
            break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
        return back()->with("success","İşleminiz Başarıyla Tamamlandı");
    }
}
