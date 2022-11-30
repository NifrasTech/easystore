<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Image;

class SettingController extends Controller
{
    public function gotoSettings(){
        $pageConfigs = ['pageHeader' => false];

        return view('settings',['pageConfigs' => $pageConfigs,'settings'=>Setting::take(1)->first()]);
    }

    public function storeSettings(Request $request){
        // dd($request);
        $file = $request->file('logo');
        $settings = Setting::first();
        $input['logo'] = $settings->logo;
        if(isset($file)){
            $this->validate($request, [
                'logo' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ]);

            $image = $request->file('logo');
            // $input['logo'] = time().'.'.$image->getClientOriginalExtension();
            $input['logo'] = 'logo.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }

            $imgFile = Image::make($image->getRealPath());
            $imgFile->save($destinationPath.'/'.$input['logo']);
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['logo']);
        }

        $settings["store_name"]=$request->store_name;
        $settings["contact_no"]=$request->contact_no;
        $settings["email"]=$request->email;
        $settings["address"]=$request->address;
        $settings["bill_note"]=$request->bill_note;
        $settings["logo"]=$input['logo'];
        $settings->save();
        return redirect()->back();
    }
}
