<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use App\DataTables\CategoriesDataTable;
use App\DataTables\ProductsDataTable;

class AdminCategorieController extends Controller
{
    public function index(Request $request) {

        $categories = Categorie::all();
        $categoriesIDs = array();

        foreach( $categories as $categorie ) {
            array_push($categoriesIDs, $categorie->id);
        }

        $dataTable = new CategoriesDataTable($categoriesIDs);

        return $dataTable->render('admin.categories.index', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function products(Categorie $categorie)
    {
        $products = Product::where('categorie', $categorie->nom)->get();
        $productsIDs = array();

        foreach( $products as $product ) {
            array_push($productsIDs, $product->id);
        }

        $dataTable = new ProductsDataTable($productsIDs);
        $tableTitle = 'Liste de produits : '.$categorie->nom;

        return $dataTable->render('admin.categories.products', [
            'admin' => AdminMainController::admin(),
            'tableTitle' => $tableTitle,
        ]);
    }

    public function show(Request $request)
    {
        return view('admin.categories.show', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.categories.create', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function store(Request $request)
    {
        
    }

    public function edit(Request $request)
    {
        return view('admin.categories.edit', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function update(Request $request)
    {
        
    }

    public function destroy(Request $request)
    {
        
    }
}
