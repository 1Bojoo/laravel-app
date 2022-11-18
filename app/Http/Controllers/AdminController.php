<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\User;

class AdminController extends Controller
{
    public function ann() {
        $anns = Announcement::all();

        return view('pages.admin.annAd', compact('anns'));
    }

    public function users() {
        $users = User::all();

        return view('pages.admin.userAd', compact('users'));
    }

    public function destroy($id) {
        $flight = User::find($id);
        $flight->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
