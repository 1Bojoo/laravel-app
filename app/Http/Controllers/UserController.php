<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Reservation;
use Auth;

class UserController extends Controller
{
    public function showAnn(){
        $userID = auth()->user()->id;
        // $res = Reservation::where('userID', $userID)->pluck('annID');
        // $anns = Announcement::find($userID);
        $anns = Announcement::where('userID', $userID)->get();

        return view('pages.user.userAnn', compact('anns'));
    }

    public function showRes(){


        return view('pages.user.userRes');
    }
}
