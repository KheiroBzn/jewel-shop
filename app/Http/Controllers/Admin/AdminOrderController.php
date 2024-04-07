<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\DataTables\OrdersDataTable;
use App\Models\OrderDetails;
use App\Models\Invoice;
use App\Models\Livraison;
use App\Models\Paymant;
use App\Models\CcpImage;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $dataTable = new OrdersDataTable();
        return $dataTable->render('admin.orders.index', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function show($id) {

        $order = Order::findOrFail($id);

        $orderDetails = OrderDetails::where('id_commande', $id)
                                    ->join('products', 'products.id', '=', 'order_details.id_bijou')
                                    ->get();

        $invoice = Invoice::where('id_commande', $id)->first();

        $client = Client::findOrFail($order->id_client);

        return view('admin.orders.show', [
            'admin'        => AdminMainController::admin(),
            'order'        => $order,
            'orderDetails' => $orderDetails,
            'invoice'      => $invoice,
            'client'       => $client,
        ]);
    }

    public function showPaymant($id) {
        $order = Order::findOrFail($id);

        $client = Client::findOrFail($order->id_client);

        $paymant = Paymant::where('id_commande', $order->id)->first();
        $image = CcpImage::where('id_paiement', $paymant->id)->first();

        return view('admin.orders.showPaymant', [
            'admin'        => AdminMainController::admin(),
            'order'        => $order,
            'paymant'      => $paymant,
            'image'        => $image,
            'client'       => $client,
        ]);
    }

    public function create(Request $request) {

        return view('admin.orders.create', [
            'admin' => AdminMainController::admin(),
            'products' => Product::all(),
            'clients'  => Client::all(),
        ]);
    }

    public function edit($order) {

        return view('admin.orders.edit', [
            'admin' => AdminMainController::admin(),
            'products' => Product::all(),
            'clients'  => Client::all(),
        ]);
    }

    public function update($id) {


        return to_route('orders.index');
    }

    public function validateOrder($id) {
        
        $order = Order::findOrFail($id);
        $order->update([
            'etat' => 'validee'
        ]);

        return to_route('orders.index');
    }

    public function cancel($id) {

        $order = Order::findOrFail($id);
        $order->update([
            'etat' => 'annulee',
        ]);

       /*  $paymant = Paymant::findOrFail($order->id);
        if(isset($paymant)) {
            if( $paymant->count() > 0 ) {
                $paymant->update([
                    'etat' => 'non_valide',
                ]);
            }
        } */

        return to_route('orders.index');
    }

    public function deliver($id) {

        $order = Order::findOrFail($id);
        $order->update([
            'etat' => 'en_livraison',
        ]);
        return to_route('orders.index');
    }

    public function back($id) {

        $order = Order::findOrFail($id);
        $order->update([
            'etat' => 'retour',
        ]);

        return to_route('orders.index');
    }

    public function success($id) {

        $order = Order::findOrFail($id);
        $order->update([
            'etat' => 'livree',
        ]);

        return to_route('orders.index');
    }

    public function destroy($id) {

        $order = Order::findOrFail($id);

        $orderDetails = OrderDetails::where('id_commande', $id)->get();
        $invoice = Invoice::where('id_commande', $id)->get();
        $livraison = Livraison::where('id_commande', $id)->get();

        foreach($orderDetails as $row) {
            $row->delete();
        }

        foreach($invoice as $row) {
            $row->delete();
        }

        foreach($livraison as $row) {
            $row->delete();
        }
        
        $order->delete();

        return to_route('orders.index');
    }
}
