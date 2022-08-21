<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function editShippingMethods($type){
        if (in_array($type, ['free', 'local', 'outer'])) {
            $shippingMethod = Setting::where('key',$type.'_shipping_label')->first();
            return view('dashboard.settings.shippings.edit' , compact('shippingMethod'));
        } else {
            return redirect() ->back()->with(['error' => 'No Shipping Method Match Selection']);
        }
    }

    //Edit Shipping Methods Into Database
    public function updateShippingMethods(Request $request,$id) {
        try {
            $shippingMethod = Setting::find($id);
            $shippingMethod->update(['plain_value' => $request->cost]);
            $shippingMethod->value = $request->key;
            $shippingMethod->save();
            return redirect()->back()->with(['success' => __('admin/index.Updated Successfully Into Database')]);
        } catch(Exception $exception) {
            return __('admin/index.Something Went Wrong While Updating Into Database Please Try Again');
        }
    }
}



