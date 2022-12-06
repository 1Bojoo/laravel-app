<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
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

        $res = DB::table('announcements')
                    ->leftJoin('reservation', 'announcements.id', '=', 'reservation.announcement_id')
                    ->where('reservation.user_id', $userID)
                    ->get();


        return View::make('pages.user.userRes')
        ->with(compact('res'));
    }

    public function destroyAnn($id){
        $annID = Announcement::where('id', $id)->pluck('id');
        Reservation::where('announcement_id', $annID)->delete();
        Announcement::where('id', $id)->delete();
        return redirect(route('myann'));
    }

    public function editAnn(Announcement $ann){
        return view('pages/user/userAnnEdit', compact('ann'));
    }

    public function updateAnn(Request $request, Announcement $ann){
        $ann->fill($request->all());
        $ann->save();
        return redirect(route('myann'));
    }

    public function destroyRes($id){
        Reservation::where('id', $id)->delete();
        return redirect(route('myres'));
    }

}
