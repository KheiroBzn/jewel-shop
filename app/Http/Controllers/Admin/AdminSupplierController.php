<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use App\DataTables\SuppliersDataTable;
use App\DataTables\ProductsDataTable;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Supply;
use Illuminate\Http\Request;

class AdminSupplierController extends Controller
{
    public function index(Request $request)
    {
        $dataTable = new SuppliersDataTable();
        return $dataTable->render('admin.suppliers.index', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('admin.suppliers.show', [
            'admin' => AdminMainController::admin(),
            'supplier' => $supplier,
            'products' => Product::where('id_fournisseur', $id)->get(),
        ]);
    }

    public function products(Supplier $supplier)
    {
        $categories = Categorie::all();
        $products = Product::where('id_fournisseur', $supplier->id)->get();
        $productsIDs = array();

        foreach( $products as $product ) {
            array_push($productsIDs, $product->id);
        }

        $dataTable = new ProductsDataTable($productsIDs);
        $tableTitle = 'Liste de produit fournis par : '.$supplier->nom;

        return $dataTable->render('admin.suppliers.products', [
            'admin' => AdminMainController::admin(),
            'categories' => $categories,
            'tableTitle' => $tableTitle,
        ]);
    }


    public function create(Request $request)
    {
        return view('admin.suppliers.create', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function store(Request $request)
    {
        $supplier = Supplier::create([
            'nom' => $request->nom,
            'location' => $request->location,
            'tel' => $request->tel,
        ]);

        return to_route('suppliers.index');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('admin.suppliers.edit', [
            'admin' => AdminMainController::admin(),
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'nom' => $request->nom,
            'location' => $request->location,
            'tel' => $request->tel,
            'updated_at' => now()
        ]);

        return to_route('suppliers.index');
    }

    public function destroy(Request $request)
    {
        
    }

}
