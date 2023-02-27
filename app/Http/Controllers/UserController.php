<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use App\Models\User;
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

    public function qrLogin(Request $request){
        $qr = $request->qr_code;
        $qrData = explode('|', $qr);

        $credentials = ['email'=>$qrData[0], 'password'=>$qrData[1]];
     
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
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
            $qrcode = QrCode::size(500)->margin(1)->format('png')->generate($data, '../public/qrcodes/qrcode.png');
            $pathToImage = '../public/qrcodes/qrcode.png';
            Mail::to($userEmail)->send(new sendQR($pathToImage));
            return response('Udało się!');
        }
        else{
            return response('Błędne hasło');
        }
    }

}
