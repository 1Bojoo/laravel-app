<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dormitory;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomBedClothes;
use App\Models\Storage;

use Illuminate\Support\Facades\Mail;
use App\Mail\mailAfterEditRole;

class AdminController extends Controller
{

    public function stats(){

        $rooms = Room::all();

        $storage = Storage::first();

        $freeRooms = Room::where('isOwned', 0)->get();

        $occRooms = Room::where('isOwned', 1)->whereNotNull('userID')->get();

        $offRooms = Room::where('isOwned', 1)->whereNull('userID')->get();

        return view('pages.admin.statsPanel', compact('rooms', 'freeRooms', 'occRooms', 'offRooms', 'storage'));
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

    public function res() {
        $res = Reservation::all();

        return view('pages.admin.userRes', compact('res'));
    }

    public function deleteRes($resID) {
        $res = Reservation::where('id', $resID)->first();

        $room = Room::where('id', $res->room->id)->first();

        if($room->reservation->count() > 1){

            if($room->userID == $res->user_id){

                $a = $room->reservation->where('user_id', '!=', $res->user_id)->first();

                Room::where('id', $res->room->id)->update(['userID' => $a->user_id]);

                $b = RoomBedClothes::where('reservation_id', $res->id)->first();

                Storage::increment('pillow', $b->pillow);
                Storage::increment('duvet', $b->duvet);
                Storage::increment('bedsheet', $b->bedsheet);
                Storage::increment('bedclothes', $b->bedclothes);

                RoomBedClothes::where('reservation_id', $res->id)->delete();

                Reservation::where('id', $resID)->delete();

            }else{

                $b = RoomBedClothes::where('reservation_id', $res->id)->first();

                Storage::increment('pillow', $b->pillow);
                Storage::increment('duvet', $b->duvet);
                Storage::increment('bedsheet', $b->bedsheet);
                Storage::increment('bedclothes', $b->bedclothes);

                RoomBedClothes::where('reservation_id', $res->id)->delete();
                
                Reservation::where('id', $resID)->delete();
                
            }

        }else{

            Room::where('id', $res->room->id)->update(['isOwned' => false,'userID' => null]);

            $b = RoomBedClothes::where('reservation_id', $res->id)->first();

            Storage::increment('pillow', $b->pillow);
            Storage::increment('duvet', $b->duvet);
            Storage::increment('bedsheet', $b->bedsheet);
            Storage::increment('bedclothes', $b->bedclothes);

            RoomBedClothes::where('reservation_id', $res->room_id)->delete();

            Reservation::where('id', $resID)->delete();
        }
        
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

        if($request->role == 'student'){
            $url = route('dorm');
            $maildata = array(
                'url' => $url
            );
        }

        Mail::to($user->email)->send(new mailAfterEditRole($maildata));

        return redirect(route('users'));
    }
}
