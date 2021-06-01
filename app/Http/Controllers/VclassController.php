<?php

namespace App\Http\Controllers;

use App\Models\Vclass;
use Illuminate\Http\Request;

class VclassController extends Controller
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
        $vclasses =  Vclass::latest()->paginate(20);
        return view('vclass.index',compact(array_keys(get_defined_vars())));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vclass.create',compact(array_keys(get_defined_vars())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vclass::create($request->except('_method'));
        return redirect(route('vclass.index',['page'=>\Session::get('page_number')]))->with("success","İşleminiz Başarıyla Tamamlandı");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vclass  $vclass
     * @return \Illuminate\Http\Response
     */
    public function show(Vclass $vclass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vclass  $vclass
     * @return \Illuminate\Http\Response
     */
    public function edit(Vclass $vclass)
    {
        return view('vclass.edit',compact(array_keys(get_defined_vars())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vclass  $vclass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vclass $vclass)
    {
        $vclass->update($request->except(['_method']));
        return redirect(route('vclass.index',['page'=>\Session::get('page_number')]))->with("success","İşleminiz Başarıyla Tamamlandı");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vclass  $vclass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vclass $vclass)
    {
        $vclass->delete();
        return back()->with("success","İşleminiz Başarıyla Tamamlandı");
    }
}
