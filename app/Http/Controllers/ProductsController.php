<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Product; 
 
class ProductsController extends Controller
{
    public function index()
    {
        $cash_mashin = Product::all();
        return view('cart')->with('cash_mashin', $cash_mashin);
    }
 
    public function cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $cash_mashin = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "product_name" => $cash_mashin->name,
                "price" => $cash_mashin->price,
                "quantity" => 1,
                "discount" =>$cash_mashin->discount,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->with('success', 'Product add to cart successfully!');
    }
 
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
}
