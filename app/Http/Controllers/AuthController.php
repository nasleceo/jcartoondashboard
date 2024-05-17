<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{



    public function login()
    {
        if (Auth::check()) {
            return redirect(route('dash'));
        }

        return view('Auth.login');
    }



    function loginPost(Request $request)
    {

        $request->validate(([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]));


        $user = User::where('email', '=', $request->email)->first();


        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect()->intended(route('dash'));
            } else {
                return back()->with('error', 'password not matches');
            }
        } else {
            return back()->with('error', 'this email is not registred');
        }
    }

    function signin(Request $request)
    {


        $request->validate(([
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]));




        $data['name'] = "@"."anass_admin";
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        if (!$user) {

            return redirect(route('login'))->with("error", "login details are not valid");

        }
        return redirect(route('dash'))->with("sss", "valid");
    }



    


    function logout()
    {

        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect(route('login'));
        }
    }
}
