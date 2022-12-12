<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class AnnController extends Controller
{
    public function index() {
        $anns = Announcement::all();

        return view('pages.ann', compact('anns'));
    }

    public function selAnn($id) {

        $res = Reservation::where('announcement_id', $id)->get();

        $anns = Announcement::find($id);

        if($res->isEmpty()){

            return view('pages.selAnn', compact('anns'));

        } else{

            return view('pages.selAnn', compact('anns', 'res'));
        }
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'userID' => 'required',
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

        Announcement::create([
            'image' => implode('|', $image),
            'userID' => $request->userID,
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

        return redirect(route('myres'));
    }

    public function create(){
        $user = auth()->user()->id;

        return view('pages.crAnn', compact('user'));
    }
}
