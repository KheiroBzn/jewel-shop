<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMainController;
use App\DataTables\InvoicesDataTable;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\DataTables\OrdersDataTable;
use App\Models\OrderDetails;
use App\Models\Invoice;
use App\Models\Livraison;

use PDF;

class AdminInvoiceController extends Controller
{
    public function index(Request $request)
    {
        $dataTable = new InvoicesDataTable();
        return $dataTable->render('admin.invoices.index', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function show($id)
    {

        $invoice = Invoice::findOrFail($id);
        $order = Order::findOrFail($invoice->id_commande);
        $orderDetails = OrderDetails::where('id_commande', $order->id)
                                    ->join('products', 'products.id', '=', 'order_details.id_bijou')
                                    ->get();
        $livraison = Livraison::where('id_commande', $order->id)->first();
        $client = Client::where('id', $order->id_client)->first();

        return view('admin.invoices.showStyled', [
            'admin' => AdminMainController::admin(),
            'invoice' => $invoice,
            'order' => $order,
            'orderDetails' => $orderDetails,
            'livraison' => $livraison,
            'client' => $client,
        ]);
    }

    public function printInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $order = Order::findOrFail($invoice->id_commande);
        $orderDetails = OrderDetails::where('id_commande', $order->id)
                                    ->join('products', 'products.id', '=', 'order_details.id_bijou')
                                    ->get();
        $livraison = Livraison::where('id_commande', $order->id)->first();
        $client = Client::where('id', $order->id_client)->first();


        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $pdf = PDF::loadView('admin.invoices.show', [
            'admin' => AdminMainController::admin(),
            'invoice' => $invoice,
            'order' => $order,
            'orderDetails' => $orderDetails,
            'livraison' => $livraison,
            'client' => $client,
        ]);

        $invoice = Invoice::findOrFail($id);
        

        return $pdf->download($invoice->reference.'.pdf');
    }
}
