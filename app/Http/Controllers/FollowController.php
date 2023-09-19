<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function createFollow(User $user)
    {
        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->match = 'follow';
        $newFollow->save();

        $otherSendRequest = DB::table('follows')->where([['user_id', '=', $user->id], ['followeduser', '=', auth()->user()->id]])->get();
        $authSendRequest = DB::table('follows')->where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->get();
        //        return var_dump(count($authSendRequest));

        return view('/otherprofile', ['user' => $user, 'otherSendRequest' => $otherSendRequest, 'authSendRequest' => $authSendRequest]);
    }
    public function removeFollow(User $user)
    {
        Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->delete();
        $otherSendRequest = DB::table('follows')->where([['user_id', '=', $user->id], ['followeduser', '=', auth()->user()->id]])->get();
        $authSendRequest = DB::table('follows')->where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->get();
        //        return var_dump(count($authSendRequest));

        return view('/otherprofile', ['user' => $user, 'otherSendRequest' => $otherSendRequest, 'authSendRequest' => $authSendRequest]);
    }

    public function deleteFollow(User $user)
    {
        Follow::where([['user_id', '=', $user->id], ['followeduser', '=', auth()->user()->id]])->delete();
        Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->delete();
        $otherSendRequest = DB::table('follows')->where([['user_id', '=', $user->id], ['followeduser', '=', auth()->user()->id]])->get();
        $authSendRequest = DB::table('follows')->where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->get();
        //        return var_dump(count($authSendRequest));

        return view('/otherprofile', ['user' => $user, 'otherSendRequest' => $otherSendRequest, 'authSendRequest' => $authSendRequest]);
    }

    public function match(User $user)
    {
        Follow::where([['user_id', '=', $user->id], ['followeduser', '=', auth()->user()->id]])->delete();

        $newFollow1 = new Follow;
        $newFollow1->user_id = auth()->user()->id;
        $newFollow1->followeduser = $user->id;
        $newFollow1->match = 'match';
        $newFollow1->save();

        $newFollow2 = new Follow;
        $newFollow2->user_id =  $user->id;
        $newFollow2->followeduser = auth()->user()->id;
        $newFollow2->match = 'match';
        $newFollow2->save();

        $otherSendRequest = DB::table('follows')->where([['user_id', '=', $user->id], ['followeduser', '=', auth()->user()->id]])->get();
        $authSendRequest = DB::table('follows')->where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->get();
        return view('/otherprofile', ['user' => $user, 'otherSendRequest' => $otherSendRequest, 'authSendRequest' => $authSendRequest]);
    }
}
