<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\News;
use App\Models\Storage;
use App\Models\RoomBedClothes;
use App\Mail\SendMailAfterRes;
use App\Mail\sMail;
use App\Mail\userData;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;


class AnnController extends Controller
{
    public function index() {

        return view('pages.main');
    }

    public function dormitory() {
        $res = Reservation::all();

        $allRooms = Room::all();

        $rooms = Room::where('isOwned', false)->get();

        $guestRooms = Room::where('floor', 0)->get();

        $dorm = Dormitory::find(1);

        if($rooms->isEmpty()){

            $dates = [];

            $avRooms = [];

            return view('pages.selAnn', compact('dorm', 'dates', 'avRooms'));

        }elseif($res->isEmpty()){
            
            $dates = [];

            $avRooms = [];

            foreach($rooms as $item){
                array_push($avRooms, $item->roomNum);
            }

            return view('pages.selAnn', compact('dorm', 'dates', 'allRooms'));

        }else{

            $dates = array();

            $array = [];

            foreach($guestRooms as $item){
                $dates[$item->roomNum] = $item->roomNum;
                if(!$item->reservation->isEmpty()){
                    foreach($item->reservation as $res){
                        
                        $stDate = $res->arrDate;
                        $enDate = $res->depDate;

                        $start_timestamp = strtotime($stDate);
                        $end_timestamp = strtotime($enDate);

                        for ($i = $start_timestamp; $i <= $end_timestamp; $i = strtotime('+1 day', $i)) {
                            $date = date('Y-m-d', $i);
                            array_push($array, $date);
                        }
                    }
                }
                $dates[$item->roomNum] = $array;

                $array = [];
            }

            return view('pages.selAnn', compact('dorm', 'res', 'dates', 'allRooms'));
        }
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

    public function reservation(Request $request){

        $pillowVal = (int)$request->pillowVal;
        $duvetVal = (int)$request->duvetVal;
        $bedsheetVal = (int)$request->bedsheetVal;
        $bedclothesVal = (int)$request->bedclothesVal;        

        $roomId = (int)$request->roomId;

        $checkRoom = Room::where('id', $roomId)->first();

        dd($request->email);

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:111111111|max:999999999',
            'postalCode' => 'required|regex:/^\d{2}-\d{3}$/',
            'city' => 'required',
            'street' => 'required',
            'hNum' => 'required|max:5|string',
        ]);

        if($checkRoom->reservation->isEmpty()){
            Room::where('id', $roomId)->update(['userID' => $request->user()->id, 'isOwned' => true]);
        }

        Reservation::create([
            'user_id' => $request->user()->id,
            'room_id' => $roomId,
            'arrDate' => $request->date_start_form,
            'depDate' => $request->date_end_form,
        ]);

        $res = Reservation::where('user_id', $request->user()->id)->orderBy('id', 'desc')->first();

        Storage::decrement('pillow', $pillowVal);
        Storage::decrement('duvet', $duvetVal);
        Storage::decrement('bedsheet', $bedsheetVal);
        Storage::decrement('bedclothes', $bedclothesVal);

        RoomBedClothes::create([
            'reservation_id' => $res->id,
            'pillow' => $pillowVal,
            'duvet' => $duvetVal,
            'bedsheet' => $bedsheetVal,
            'bedclothes' => $bedclothesVal
        ]);

        $roomNum = Room::where('id', $roomId)->pluck('roomNum');
        $subject = "Rezerwacja pokoju $roomNum";
        $url = route('myres');

        $maildata = array(
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'postalCode' => $request->postalCode,
            'city' => $request->city,
            'street' => $request->street,
            'hNum' => $request->hNum,
            'subject' => $subject,
            );

        $userMailData = array(
            'subject' => $subject,
            'roomNum' => $roomNum,
            'arrDate' => $request->date_start_form,
            'depDate' => $request->date_end_form,
            'url' => $url
        );

        $userEmail = auth()->user()->email;

        $dorm = Dormitory::find(1);
        $ownerEmail = $dorm->user->email;

        Mail::to($userEmail)->send(new SendMailAfterRes($userMailData));
        Mail::to($ownerEmail)->send(new userData($maildata));

        return redirect(route('myres'));
    }

    public function guestReservation(Request $request){
        $roomId = (int)$request->guestRoomId;

        $checkRoom = Room::where('id', $roomId)->first();

        if($checkRoom->reservation->isEmpty()){
            Room::where('id', $roomId)->update(['userID' => $request->user()->id, 'isOwned' => true]);
        }

        Reservation::create([
            'user_id' => $request->user()->id,
            'room_id' => $roomId,
            'arrDate' => $request->date_start,
            'depDate' => $request->date_end,
        ]);

        $res = Reservation::where('user_id', $request->user()->id)->orderBy('id', 'desc')->first();

        Storage::decrement('pillow', 1);
        Storage::decrement('duvet', 1);
        Storage::decrement('bedsheet', 1);
        Storage::decrement('bedclothes', 1);

        RoomBedClothes::create([
            'reservation_id' => $res->id,
            'pillow' => 1,
            'duvet' => 1,
            'bedsheet' => 1,
            'bedclothes' => 1
        ]);

        return redirect(route('myres'));
    }

    public function contact(){
        return view('pages.contact');
    }

    public function rules(){
        return view('pages.rules');
    }

    public function news(){
        $news = News::orderBy('id', 'DESC')->get();

        return view('pages.news', compact('news'));
    }

    public function addNews(Request $request){

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date
        ]);

        return back();
    }

    public function deleteNews($newsID){
        News::where('id', $newsID)->delete();

        return back();
    }

    public function contactForm(Request $request){
        $ownerID = Dormitory::find(1);

        $ownerEmail = $ownerID->user->email;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => 'required',
            'message' => 'required',
        ]);

        if($validator->fails()){
            return redirect('contact')->with('status', 'fail');
        }
        
        $maildata = array(
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            );

        Mail::to($ownerEmail)->send(new sMail($maildata));

        return redirect('contact')->with('success', 'ok');
    }
}
