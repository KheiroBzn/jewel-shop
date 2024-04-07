<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\MainController;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Livraison;
use App\Models\Invoice;

use DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $client = Client::where('userid', $user->id)->first();

        $wilaya = preg_split("/\s-\s/" ,preg_split ("/\s--\s/", $client->adresse)[1])[1];

        $provinces = MainController::getDzProvinces();
        
        $delivery = 0;
        $location = $wilaya;
    
        foreach($provinces as $province) {
            if( $province[2] == $wilaya ) {
                $delivery = intval($province[3]);
                $location = $province[1];
                break;
            }
        }

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return view('orders.order', [
            'categories' => $categories,
            'delivery'   => $delivery,
            'location'   => $location,
        ]);
    }

    public function apply()
    {
        $user = auth()->user();
        $client = Client::where('userid', $user->id)->first();
        $cart = session()->get('cart', []);

        if(isset($cart)) {
            $total = 0;

            foreach( $cart as $id => $details ) {
                $total += $details['price'] * $details['quantity'];
            }

            $montant_HT = intval($total);
            $taux_TVA = 19;
            $montant_TVA = intval($montant_HT * $taux_TVA / 100);
            $montant_TTC = intval($montant_HT + $montant_TVA);

            $referenceCMD = 'C'.$client->id;

            $order = Order::create([
                'reference'       => $referenceCMD,
                'total'           => $montant_TTC,
                'etat'            => 'en_attente',
                'choix_livraison' => 'oui',
                'id_client'       => $client->id,
            ]);

            $orderID = $order->id;

            foreach( $cart as $id => $details ) {
                $sTotal = $details['price'] * $details['quantity'];
                $orderDetails = OrderDetails::create([
                    'id_commande' => $orderID,
                    'id_bijou'    => $id,
                    'qte'         => $details['quantity'],
                    'sous_total'  => $sTotal,
                    'prix_unitaire' => $details['price'],
                ]);
            }


            $wilaya = preg_split("/\s-\s/" ,preg_split ("/\s--\s/", $client->adresse)[1])[1];

            $provinces = MainController::getDzProvinces();
            
            $delivery = 0;
            $location = $wilaya;
        
            foreach($provinces as $province) {
                if( $province[2] == $wilaya ) {
                    $delivery = intval($province[3]);
                    $location = $province[1];
                    break;
                }
            }

            $livraison = Livraison::create([
                'date_livraison'    => null,
                'adresse_livraison' => $location,
                'frais_livraison'   => $delivery,
                'id_livreur'        => 1,
                'id_commande'       => $orderID,
            ]); 

            $livraisonID = $livraison->id;

            $referenceFact = 'C'.$client->id;

            $invoice = Invoice::create([
                'reference'   => $referenceFact,
                'montant_HT'  => $montant_HT,
                'montant_TTC' => $montant_TTC,
                'montant_TVA' => $montant_TVA,
                'taux_TVA'    => $taux_TVA,
                'id_commande' => $orderID,
            ]);

            $invoiceID = $invoice->id;
            $referenceFact = 'C'.$client->id.'F'.$invoiceID.'CMD'.$orderID.'L'.$livraisonID;
            $invoice->reference = $referenceFact;
            $invoice->save();

            $referenceCMD = 'C'.$client->id.'CMD'.$orderID.'F'.$invoiceID.'L'.$livraisonID;
            $order->reference = $referenceCMD;
            $order->save();

            session()->forget('cart');
        }         

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return to_route('user.index', $user->id)->with([
            'client'     => $client,
            'categories' => $categories,
            'products'   => Product::all(),
        ]);
    }

}
