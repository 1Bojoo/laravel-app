<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Room;

class AdminController extends Controller
{

    public function manPanel(){
        return view('pages.admin.managementPanel');
    }

    public function ann() {
        $anns = Announcement::all();

        return view('pages.admin.userAnn', compact('anns'));
    }

    public function room() {
        $rooms = Room::all();

        return view('pages.admin.roomManagement', compact('rooms'));
    }

    public function addRoom() {
        for($i = 1; $i<20; $i++){

        }
    }

    public function res() {
        $ann = Announcement::find(1);

        $res = $ann->reservation;

        return view('pages.admin.userRes', compact('res'));
    }

    public function users() {
        $users = User::all();

        return view('pages.admin.userAd', compact('users'));
    }

    public function destroyUser(User $user) {
        Announcement::where('userID', $user->id)->delete();
        Reservation::where('user_id', $user->id)->delete();
        $user->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroyAnn(Announcement $ann) {
        $ann->delete();
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
