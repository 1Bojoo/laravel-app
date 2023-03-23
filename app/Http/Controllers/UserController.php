<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\sendQR;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function showAnn(){
        $userID = auth()->user()->id;
        $anns = Announcement::where('userID', $userID)->get();

        return view('pages.user.userAnn', compact('anns'));
    }

    public function showRes(){
        $userID = auth()->user()->id;

        $res = Reservation::where('user_id', $userID)->get();

        return view('pages.user.userRes', compact('res'));
    }

    public function destroyRes($id){

        $res = Reservation::where('id', $id)->first();

        $room = Room::where('id', $res->room->id)->first();

        if($room->reservation->count() > 1){

            if($room->userID == $res->user_id){

                $a = $room->reservation->where('user_id', '!=', $res->user_id)->first();

                Room::where('id', $res->room->id)->update(['userID' => $a->user_id]);

                Reservation::where('id', $id)->delete();

            }else{

                dd($room);
                
                Reservation::where('id', $id)->delete();

            }

        }else{

            dd($room);

            Room::where('id', $res->room->id)->update(['isOwned' => false,'userID' => null]);

            Reservation::where('id', $id)->delete();
        }

        return redirect(route('myres'));
    }

    public function qrLogin(Request $request){
        $qr = $request->qr_code;

        $qrData = explode('|', $qr);

        $credentials = ['email'=>$qrData[0], 'password'=>$qrData[1]];
     
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dorm');
        }
        else{
            return redirect('/login')->with('message', 'Błędny kod QR');
        }
    }

    public function genQR(Request $request){
        $userEmail = auth()->user()->email;
        $userPass = $request->pass;
        $data = $userEmail."|".$userPass;
        $userHashedPass = auth()->user()->password;

        if(Hash::check($userPass, $userHashedPass)){
            $qrcode = QrCode::size(500)->margin(1)->format('png')->generate($data, "../public/qrcodes/".auth()->user()->name."QR.png");

            $pathToImage = "../public/qrcodes/".auth()->user()->name."QR.png";

            $maildata = array(
                'path' => $pathToImage
            );

            Mail::to($userEmail)->send(new sendQR($maildata));
            return response('Udało się!');
        }
        else{
            return response('Błędne hasło');
        }
    }

}
