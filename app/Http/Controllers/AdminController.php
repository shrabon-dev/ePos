<?php

namespace App\Http\Controllers;

use App\Mail\UserPasswordSend;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    // use App\Http\Controllers\HasRoles;
    function add_user(){
        $roles = Role::all();
        return view('backend.user.add_user',compact('roles'));
    }

    function add_user_store(Request $request){
        $request->validate([
            '*' => 'required',
            'email' =>'email:rfc,dns|unique:App\Models\User,email',
        ]);

        $random_password = Str::random(8);
        
        $userID =User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => Carbon::now(),
            'account_status' => 'active',
            'password' => Hash::make($random_password),
        ]);

        User::find($userID)->assignRole($request->role);
              Mail::to($request->email)->send(new UserPasswordSend($request->name,$request->email,$random_password));
              return back()->with('status','Successfully added a new user');
    }

    function user_list(){
        $users = User::all();
        return view('backend.user.userlist', compact('users'));
    }
}
