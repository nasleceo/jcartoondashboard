<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{


    public function show(){

        $users = User::withCount('favorites')->withCount(['followings', 'followables'])->withCount('likes')->
        with('user_comments')->
        with('user_posts')->get();

        return View('layouts.user.user',compact('users'));

    }

    public function verife($id){

        $users = User::find($id);

        $users['isverified'] = 1;

        $users->save();


        return redirect()->route('users');

    }

    public function unverife($id){

        $users = User::find($id);

        $users['isverified'] = 0;

        $users->save();

        return redirect()->route('users');

    }

    public function banne($id){

        $users = User::find($id);

        $users['banned'] = 1;

        $users->save();

        return redirect()->route('users');

    }


    public function unbanne($id){

        $users = User::find($id);

        $users['banned'] = 0;

        $users->save();
        return redirect()->route('users');


    }


    public function noads($id){

        $users = User::find($id);

        $users['noads'] = 1;

        $users->save();


        return redirect()->route('users');

    }

    public function ads($id){

        $users = User::find($id);

        $users['noads'] = 0;

        $users->save();

        return redirect()->route('users');

    }

    public function delet_user($id){

        $users = User::find($id);
        $users->delete();

        return redirect()->route('users');

    }


}
