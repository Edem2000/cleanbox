<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cartAdd(Request $request){
        $product = Product::findOrFail($request->id);
        if(session_id()){
            $id=session_id();
        }
        else {
            session_start();
            $id = session_id();
        }
        \Cart::session($id)->add(array(
            'id' => $product->id,
            'name' => $product->__('name'),
            'price' => $product->price,
            'quantity' => $request->quantity,
//            'img' => $product->img,
//            'description' =>$product->description,
//            'attributes' => array(),
//            'associatedModel' => $product,
        ));
//        return back() ->with(['added' => 'true', 'product' => $product -> name]);
        $msg = "This is a simple message.";
        return response()->json(array('id'=> $request->id, 'name'=>$product->__('name')), 200);
    }
    public function cartRemove(Request $request){
        $product = Product::findOrFail($request->id);
        \Cart::session(session_id())->remove($request->id);
        return response()->json(array('id'=> $request->id, 'name'=>$product->__('name')), 200);
    }
    public function decreaseCartItemQuantity(Request $request){
        \Cart::session(session_id())->update($request->id, array(
            'quantity' =>  -1 ,
        ));
        return back();
    }
    public function increaseCartItemQuantity(Request $request){
        \Cart::session(session_id())->update($request->id, array(
            'quantity' =>  1 ,
        ));
        return response()->json(array('success'=>'success'));
    }
    public function getCartQuantity(){
        $quantity = \Cart::session(session_id())->getContent()->count();
        return response()->json(array('quantity'=> $quantity), 200);
    }
}
