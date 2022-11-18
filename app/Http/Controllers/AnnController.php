<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnController extends Controller
{
    public function index() {
        $anns = Announcement::all();

        return view('pages.ann', compact('anns'));
    }

    public function selAnn($id) {
        $anns = Announcement::find($id);

        return view('pages.selAnn', compact('anns'));
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

        Announcement::create([
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

        return redirect('/pages/ann');
    }

    // public function reservation(Request $request) {
    //     $request->validate([
    //         'name' => 'required',
    //         'desc' => 'required',
    //         'price' => 'required',
    //         'country' => 'required',
    //         'city' => 'required',
    //         'province' => 'required',
    //         'street' => 'required',
    //         'hNum' => 'required',
    //         'postalCode' => 'required',

    //     ]);

    //     Announcement::create([
    //         'image' => implode('|', $image),
    //         'name' => $request->name,
    //         'desc' => $request->desc,
    //         'price' => $request->price,
    //         'country' => $request->country,
    //         'city' => $request->city,
    //         'province' => $request->province,
    //         'street' => $request->street,
    //         'hNum' => $request->hNum,
    //         'postalCode' => $request->postalCode,
    //     ]);

    //     return redirect('/pages/ann');
    // }

    public function create(){
        return view('pages.crAnn');
    }
}
