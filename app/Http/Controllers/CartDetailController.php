<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartDetail;

class CartDetailController extends Controller
{
    public function store(Request $request){

        $cartDetail = new CartDetail();
        $cartDetail->cart_id = auth()->user()->cart->id;
        $cartDetail->product_id = $request->product_id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->save();

        $notification_add = 'Producto añadido al carrito';
        return back()->with(compact('notification_add'));
    }




    public function destroy(Request $request){

        $cartDetail = CartDetail::find($request->cart_detail_id);
        $notification = 'Producto eliminado con éxito';
        if($cartDetail->cart_id == auth()->user()->cart->id){

            $cartDetail->delete();
        }

        return back()->with(compact('notification'));
    }

}
