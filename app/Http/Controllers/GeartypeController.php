<?php

namespace App\Http\Controllers;

use App\Models\Geartype;
use Illuminate\Http\Request;

class GeartypeController extends Controller
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
        $geartypes =  Geartype::latest()->paginate(20);
        return view('geartype.index',compact(array_keys(get_defined_vars())));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('geartype.create',compact(array_keys(get_defined_vars())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Geartype::create($request->except('_method'));
        return redirect(route('geartype.index',['page'=>\Session::get('page_number')]))->with("success","İşleminiz Başarıyla Tamamlandı");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Geartype  $geartype
     * @return \Illuminate\Http\Response
     */
    public function show(Geartype $geartype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Geartype  $geartype
     * @return \Illuminate\Http\Response
     */
    public function edit(Geartype $geartype)
    {
        return view('geartype.edit',compact(array_keys(get_defined_vars())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Geartype  $geartype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Geartype $geartype)
    {
        $geartype->update($request->except(['_method']));
        return redirect(route('geartype.index',['page'=>\Session::get('page_number')]))->with("success","İşleminiz Başarıyla Tamamlandı");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Geartype  $geartype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Geartype $geartype)
    {
        $geartype->delete();
        return back()->with("success","İşleminiz Başarıyla Tamamlandı");
    }
}
