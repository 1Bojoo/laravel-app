<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Reservation;
use Auth;

class UserController extends Controller
{
    public function showAnn(){
        $userID = auth()->user()->id;
        $anns = Announcement::where('userID', $userID)->get();

        return view('pages.user.userAnn', compact('anns'));
    }

    public function showRes(){
        $userID = auth()->user()->id;
        $res = Reservation::where('user_id', $userID)->pluck('announcement_id');
        $anns2 = Announcement::where('id', $res)->get();
        $anns = User::find($userID)->reservation;

        $merged = $anns->merge($anns2);
        $result = $merged->all();

        return View::make('pages.user.userRes')
        ->with(compact('result'));
    }
}
