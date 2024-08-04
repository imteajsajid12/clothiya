<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{

    public function index(){
        $shippings=Shipping::get();
        return view('backend.setup_configurations.cities.shippingindex', compact('shippings'));
    }

    public function create(){

    }

    public function store(Request $request){
        $shipping = new Shipping;
        $shipping->name = $request->name;
        $shipping->cost = $request->cost;

        $shipping->save();

        flash(translate('Shipping has been inserted successfully'))->success();

        return back();
    }

    public function edit(Request $request, $id)
    {
         $shipping  = Shipping::findOrFail($id);
         return view('backend.setup_configurations.cities.shippingedit', compact('shipping'));
    }

    public function update(Request $request)
    {
        $shipping  = Shipping::findOrFail($request->id);
        $shipping->name = $request->name;
        $shipping->cost = $request->cost;
        $shipping->save();

        flash(translate('Shipping has been updated successfully'))->success();
        return back();
    }

    public function destroy($id)
    {
        Shipping::destroy($id);

        flash(translate('Shipping has been deleted successfully'))->success();
        return redirect()->route('shipping.index');
    }

    public function update_status(Request $request){
        $shipping = Shipping::findOrFail($request->id);
        $shipping->status = $request->status;
        $shipping->save();

        return 1;
    }
}
