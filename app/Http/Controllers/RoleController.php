<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller
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

        $roles =  Role::latest()->paginate(20);
        return view('role.index',compact(array_keys(get_defined_vars())));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('role.create',compact(array_keys(get_defined_vars())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request["panelLogin"] = $request->panelLogin ? $request->panelLogin : 0;
        $request['name'] = Str::slug($request->name);
        Role::create($request->except('_method'));
        return redirect(route('role.index',['page'=>\Session::get('page_number')]))->with("success","Your transaction has been completed successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, Request $request)
    {
        return view('role.edit',compact(array_keys(get_defined_vars())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request["panelLogin"] = $request->panelLogin ? (bool)$request->panelLogin : 0;
        $request['name'] = Str::slug($request->name);
        $role->update($request->except(['_method']));
        return redirect(route('role.index',['page'=>\Session::get('page_number')]))->with("success","Your transaction has been completed successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return back()->with("success","Your transaction has been completed successfully");
        } catch (Exception $e) {
            return back()->with("error","Something went wrong while processing your transaction. This may be because you tried to delete a record that cannot be deleted.");
        }
    }
}
