<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendUserRegistered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->role){
            $users = User::whereHas('role',function($r) use($request){
                $r->where('name',$request->role);
            })->latest()->paginate(10);
        }else{
            $users = User::latest()->paginate(10);
        }
        return view('user.index',compact(array_keys(get_defined_vars())));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create',compact(array_keys(get_defined_vars())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = rand(100000,999999);
        $request['password'] = Hash::make($password);
       // Mail::to($request->email)->send(new SendUserRegistered($request->email,$password));
        User::create($request->all());

        return back()->with("success","Your transaction has been completed successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit',compact(array_keys(get_defined_vars())));
    }


    public function sendCredentials(Request $request)
    {
        $newPassword = rand(100000,999999);
        $password = Hash::make($newPassword);
        $user = User::findOrFail($request->id);
        Mail::to($user->email)->send(new SendUserRegistered($user->email,$newPassword));
        $user->password = $password;
        $user->save();
        return back()->with("success","Giriş bilgileri Kullanıcıya mail olarak gönderildi.");
    }

    public function profileEdit(Request $request){
        $user = Auth::user();
        if($request->passwordReset){
            if(Hash::check($request['password'], $user->password)){
                $user->update(['password'=>Hash::make($request['new_password'])]);
                return back()->with("success","İşleminiz Başarıyla Tamamlandı.");
            }else{
                return back()->with("error","Şifrenizi yanlış girdiniz.");
            }
        }
        elseif ($request->updateUserInformation) {
            $request->validate(['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
                if($request->file('file')) {
                    if(!strstr($user->imagePath,'no-image')){
                        Storage::delete($user->imagePath);
                    }
                    $request['imagePath'] = $request->file('file')->store('users/'.$user->id.'/profile-image');
                    $request['photo'] = Storage::url($request['imagePath']);
                }
                Auth::user()->update($request->except(['_token','updateUserInformation','file']));
                return back()->with("success","İşleminiz Başarıyla Tamamlandı.");
        }
        return view('user.profile.edit',compact(array_keys(get_defined_vars())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->email != $user->email){
            $password = rand(100000,999999);
            $request['password'] = Hash::make($password);
            Mail::to($request->email)->send(new SendUserRegistered($request->email,$password));
        }
        $user = $user->update($request->except(['_method','redirect']));
        switch ($request->redirect) {
            case 'saveAndGoBack':
                return redirect(route('user.index'))->with("success","Your transaction has been completed successfully.");
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with("success","Your transaction has been completed successfully.");
    }
}
