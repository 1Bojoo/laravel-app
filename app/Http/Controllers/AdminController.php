<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dormitory;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Room;

class AdminController extends Controller
{

    public function manPanel(){
        return view('pages.admin.managementPanel');
    }

    public function dorm() {
        $dorm = Dormitory::all();

        return view('pages.admin.userAnn', compact('dorm'));
    }

    public function room() {
        $rooms = Room::all();

        return view('pages.admin.roomManagement', compact('rooms'));
    }

    public function editRoom($roomNum) {
        $room = Room::where('roomNum', $roomNum)->first();

        if($room->isOwned == false){
            Room::where('roomNum', $roomNum)->update(['isOwned' => true]);
        }
        else{
            Room::where('roomNum', $roomNum)->update(['isOwned' => false]);
        }

        return back();
    }

    public function addRoom() {
        for($i = 1; $i<20; $i++){

        }
    }

    public function res() {
        $res = Reservation::all();

        return view('pages.admin.userRes', compact('res'));
    }

    public function deleteRes($resID) {
        $res = Reservation::where('id', $resID)->pluck('room_id');

        Room::where('id', $res)->update(['isOwned' => false]);

        Reservation::where('id', $resID)->delete();
        
        return back();
    }

    public function editRes(Request $request, $resID){

        $roomNum = $request->roomNum;

        $roomID = Room::where('roomNum', $roomNum)->pluck('id')->first();

        Room::where('id', 
            Reservation::where('id', $resID)->pluck('room_id')->first()
        )->update(['isOwned' => false]);

        Reservation::where('id', $resID)->update(['room_id' => $roomID]);

        Room::where('id', 
            Reservation::where('id', $resID)->pluck('room_id')->first()
        )->update(['isOwned' => true]);

        return back();
    }

    public function users() {
        $users = User::all();

        return view('pages.admin.userAd', compact('users'));
    }

    public function destroyUser(User $user) {
        Dormitory::where('userID', $user->id)->delete();
        Reservation::where('user_id', $user->id)->delete();
        $user->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    
    public function destroyAnn(Dormitory $dorm) {
        $dorm->delete();
    }

    public function create() {
        return view('pages.admin.createUser');
    }

    public function store(Request $request) {
        $user = new User($request->all());
        $user->save();
        return redirect(route('users'));
    }

    public function edit(User $user) {
        return view('pages.admin.editUser', compact('user'));
    }

    public function update(Request $request, User $user){
        $user->fill($request->all());
        $user->save();
        return redirect(route('users'));
    }
}
