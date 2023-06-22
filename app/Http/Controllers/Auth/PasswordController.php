<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request){

        $request->validate([
            'current_password'=>'required',
            'password'=>['required', 'confirmed','different:current_password', Password::min(8)],
            'password_confirmation'=>'required',
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)){
            User::find(auth()->id())->update([
                'password'=>Hash::make($request->password),
            ]);
            return back()->with('status','Password Changed Successfully ');
        }
        else{
            return back()->withErrors('Your provided current password does not matched!');
        };
        // $validated = $request->validateWithBag('updatePassword', [
        //     'current_password' => ['required', 'current_password'],
        //     'password' => ['required', Password::defaults(), 'confirmed'],
        // ]);

        // $request->user()->update([
        //     'password' => Hash::make($validated['password']),
        // ]);

        return back()->with('status', 'password-updated');
    }
}
