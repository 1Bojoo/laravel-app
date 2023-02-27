<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use App\Models\Reservation;
use App\Models\User;
use App\Mail\SendMailAfterRes;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class AnnController extends Controller
{
    public function index() {
        $dorm = Dormitory::all();

        return view('pages.ann', compact('dorm'));
    }

    public function dormitory() {
        $res = Reservation::all();

        $dorm = Dormitory::find(1);

        if($res->isEmpty()){

            $dates = [];

            return view('pages.selAnn', compact('dorm', 'dates'));

        } else{

            $dates = [];
            
            foreach($res as $range){
                $stDate = $range->arrDate;
                $enDate = $range->depDate;

                $start_timestamp = strtotime($stDate);
                $end_timestamp = strtotime($enDate);

                for ($i = $start_timestamp; $i <= $end_timestamp; $i = strtotime('+1 day', $i)) {
                    $date = date('Y-m-d', $i);
                    array_push($dates, $date);
                }
            }

            return view('pages.selAnn', compact('dorm', 'res', 'dates'));
        }

        return view('pages.selAnn', compact('dorm', 'dates'));
    }

    public function selAnn($id) {

        $res = Reservation::where('announcement_id', $id)->get();

        $dorm = Dormitory::find($id);

        $images = Dormitory::where('id', $id)->pluck('image');

        if($res->isEmpty()){

            $dates = [];

            return view('pages.selAnn', compact('dorm', 'dates'));

        } else{

            $dates = [];
            
            foreach($res as $range){
                $stDate = $range->arrDate;
                $enDate = $range->depDate;

                $start_timestamp = strtotime($stDate);
                $end_timestamp = strtotime($enDate);

                for ($i = $start_timestamp; $i <= $end_timestamp; $i = strtotime('+1 day', $i)) {
                    $date = date('Y-m-d', $i);
                    array_push($dates, $date);
                }
            }

            return view('pages.selAnn', compact('dorm', 'res', 'dates', 'images'));
        }
    }

    public function addRooms($numOfRooms, $floor){

        $dormitory = Dormitory::find(1);

        if($floor == 0){
            for($i = 1; $i<=$numOfRooms; $i++){
                $room = new Room;
                $room->annId = 1;
                $room->roomNum = $i;
                $room->floor = 0;
                $room->isOwned = false;
                $dormitory = $dormitory->rooms()->save($room);
            }
        }else{
            for($i = 1; $i<=$numOfRooms; $i++){
                $room = new Room;
                $room->annId = 1;
                $room->roomNum = ($floor*100)+$i ;
                dd($room->roomNum);
                $room->floor = $floor;
                $room->isOwned = false;
                $dormitory = $dormitory->rooms()->save($room);
            }
        }
    }

    public function delImage($imageID){

        $img = [];

        $images = Dormitory::find(1)->pluck('image');

        $images = (string) $images;

        $images = implode("", explode("\\", $images));
        $images = implode("", explode('["', $images));
        $images = implode("", explode('"]', $images));

        $img = explode("|", $images);

        unset($img[$imageID]);

        $img = array_values($img);

        $imgToDB = implode("|", $img);

        Dormitory::find(1)->update(['image' => $imgToDB]);

        return back();

    }

    public function addImage(Request $request){

        $images = Dormitory::find(1)->pluck('image');

        $images = (string) $images;

        $images = implode("", explode("\\", $images));
        $images = implode("", explode('["', $images));
        $images = implode("", explode('"]', $images));

        $images = explode("|", $images);

        $image = array();

        if($request->hasFile('image')){
            $files = $request->file('image');
            foreach($files as $file){
                $image_name = md5(rand(1000,10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_url = 'storage/images/'.$image_full_name;

                $file->storeAs('images', $image_full_name);

                $image[] = $image_url;
            }
        }

        $imgToDB = array_merge($images, $image);

        $imgToDB = implode("|", $imgToDB);

        Dormitory::find(1)->update(['image' => $imgToDB]);

        return back();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'country' => 'required',
            'city' => 'required',
            'province' => 'required',
            'street' => 'required',
            'hNum' => 'required',
            'postalCode' => 'required',

        ]);

        $image = array();

        if($request->hasFile('image')){
            $files = $request->file('image');
            foreach($files as $file){
                $image_name = md5(rand(1000,10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_url = 'storage/images/'.$image_full_name;

                $file->storeAs('images', $image_full_name);

                $image[] = $image_url;
            }
        }

        Dormitory::create([
            'image' => implode('|', $image),
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
            'country' => $request->country,
            'city' => $request->city,
            'province' => $request->province,
            'street' => $request->street,
            'hNum' => $request->hNum,
            'postalCode' => $request->postalCode,
        ]);

        return redirect('/');
    }

    public function reservation(Request $request){
        Reservation::create([
            'announcement_id' => $request->annId,
            'user_id' => $request->user()->id,
            'arrDate' => $request->date_start,
            'depDate' => $request->date_end,
        ]);

        $userEmail = auth()->user()->email;
        $res = Reservation::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->pluck('announcement_id')->first();
        $ann = Dormitory::where('id', $res)->orderBy('id', 'desc')->pluck('userID')->first();
        $owner = User::where('id', $ann)->pluck('email');

        Mail::to($userEmail)->send(new SendMailAfterRes());
        Mail::to($owner)->send(new SendMailAfterRes());

        return redirect(route('myres'));
    }

    public function create(){
        $user = auth()->user()->id;

        return view('pages.crAnn', compact('user'));
    }
}
