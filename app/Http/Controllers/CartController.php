<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\MainController;

use App\Models\Categorie;
use App\Models\Product;

class CartController extends Controller
{
    public function cart()
    {
        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return view('cart.cart', [
            'categories' => $categories,
        ]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {   
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $product = Product::findOrFail($id);
            $categorie = $product->categorie;
            $categorieID = Categorie::where('nom', $categorie)->first();
            $image = 'images/jewelry/'.$product->categorie.'/'.$product->nom.'/'.$product->nom.' img1.jpg';
            $current_promotions = MainController::getCurrentPromotions();
            $price = $product->prix_vente;
            foreach( $current_promotions as $promotion ) {
                if( $product->id == $promotion->id_article ) {
                    $price = $promotion->nouveau_prix_vente;
                }
            }
            $cart[$id] = [
                "name" => $product->nom,
                "quantity" => 1,
                "price" => $price,
                "image" => $image,
                "categorie" => $categorie,
                "categorieID" => $categorieID,
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    /* public function cartList()
    {
        $cartItems = \Cart::getContent();
        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();
        $current_promotions = MainController::getCurrentPromotions();
        // dd($cartItems);
        return view('cart.cart', compact([
            'cartItems',
            'categories',
            'current_promotions',
        ]));
    } */


    /* public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.list');
    } */

    /* public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->qte
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    } */

    /* public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    } */

    /* public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    } */
}
