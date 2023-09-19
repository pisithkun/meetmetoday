<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
    public function signin(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            //            $request->session()->regenerate();

            $ip = '106.146.19.170';
            $position = Location::get($ip);
            $user1 = Auth::user();
            $user1->Countryname = $position->countryName;
            $user1->Regionname = $position->regionName;
            $user1->Cityname = $position->cityName;
            $user1->latitude = $position->latitude;
            $user1->longitude = $position->longitude;
            $user1->save();

            $otherUsers = User::where('id', '<>', auth()->user()->id)->get();
            $followers_count = 0;
            $following_count = 0;

            return view('/home', ['otherUsers' => $otherUsers, 'userdistance' => 50, 'followingcount' => $following_count, 'followerscount' => $followers_count]);
        } else {
            return redirect('/')->with('failure', 'Invalid login');
        }
    }

    public function signup()
    {
        return view('signup');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You are logged out');
    }

    public function register(Request $request)
    {

        $position = Location::get('119.173.136.35');
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']


        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $incomingFields['Countryname'] = $position->countryName;
        $incomingFields['Regionname'] = $position->regionName;
        $incomingFields['Cityname'] = $position->cityName;
        $incomingFields['latitude'] = $position->latitude;
        $incomingFields['longitude'] = $position->longitude;
        User::create($incomingFields);
        return redirect('/')->with('success', 'Registration Completed! Now you can login with your username and password');
    }

    public function goback()
    {
        return view('signin');
    }
    public function showHome(User $user)
    {
        if (auth()->check()) {

            $ip = '106.146.19.170';
            $position = Location::get($ip);
            $user1 = Auth::user();
            $user1->Countryname = $position->countryName;
            $user1->Regionname = $position->regionName;
            $user1->Cityname = $position->cityName;
            $user1->latitude = $position->latitude;
            $user1->longitude = $position->longitude;
            $user1->save();

            $otherUsers = User::where('id', '<>', auth()->user()->id)->get();
            return view('/home', ['otherUsers' => $otherUsers, 'userdistance' => 50, 'followers' => $user->followers()->latest()->get(), 'following' => $user->following()->latest()->get()]);
        } else {
            return view('/signin');
        }
    }

    public function showUserDistance(Request $request)
    {
        //        $request->session()->regenerate();
        $otherUsers = DB::table('users')->where('id', '<>', auth()->user()->id)->get();
        return view('/home', ['otherUsers' => $otherUsers, 'userdistance' => $request->slider]);
    }

    public function profile(User $user)
    {
        $otherSendRequest = DB::table('follows')->where([['followeduser', '=', auth()->user()->id]])->get();
        $authSendRequest = DB::table('follows')->where([['user_id', '=', auth()->user()->id]])->get();
        return view('/profile', ['user' => $user, 'otherSendRequest' => $otherSendRequest, 'authSendRequest' => $authSendRequest, 'followers' => $user->followers()->latest()->get(), 'following' => $user->following()->latest()->get()]);
    }

    public function edit(User $user)
    {
        return view('/editprofile', ['user' => $user, 'followers' => $user->followers()->latest()->get(), 'following' => $user->following()->latest()->get()]);
    }
    public function update(Request $request, User $user)
    {
        $user1 = Auth::user();

        if ($request->avatar) {
            $request->validate([
                'avatar' => 'image'
            ]);
            $filename = auth()->user()->id . '-' . uniqid() . '.jpg';
            $request->file('avatar')->storeAs('public/avatars/', $filename);
            $oldAvatar = $user->avatar;
            $user->avatar = $filename;
        }

        $user1->from = $request->from;
        $user1->hobby = $request->hobby;
        $user1->Aboutme = $request->Aboutme;
        $user1->save();
        if (isset($oldAvatar)) {
            Storage::delete(str_replace("/storage/", "public/", $oldAvatar));
        }
        return view('/profile', ['user' => $user, 'followers' => $user->followers()->latest()->get(), 'following' => $user->following()->latest()->get()]);
    }
    public function otherProfile(User $user)
    {

        $otherSendRequest = DB::table('follows')->where([['user_id', '=', $user->id], ['followeduser', '=', auth()->user()->id]])->get();
        $authSendRequest = DB::table('follows')->where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->get();
        //        return var_dump(count($authSendRequest));

        return view('/otherprofile', ['user' => $user, 'otherSendRequest' => $otherSendRequest, 'authSendRequest' => $authSendRequest]);
    }
}
