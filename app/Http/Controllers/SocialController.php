<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    function email_send(){
        $users = User::all();
        return view('backend.email.email_send',compact('users'));
    }
    function email_template_create(){

        return view('backend.email.create');
    }
}
