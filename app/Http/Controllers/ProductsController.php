<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Image;
use App\Models\Promotion;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function index(string $catID) {

        $cat = Categorie::where('categories.id', $catID)
                        ->join('images', 'images.id', '=', 'categories.id_image')
                        ->select('categories.*', 'images.emplacement')->first();

        $catProducts = Product::where('categorie', $cat->nom)->get();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        $current_promotions = MainController::getCurrentPromotions();

        return view('products.index', [
            'categories'  => $categories,
            'allProducts' => Product::all(),
            'categorie'   => $cat,
            'catProducts' => $catProducts,
            'current_promotions' => $current_promotions,
            'search'    => '',
            'filter'    => '',
        ]);
    }

    public function indexFiltering(Request $request, $catID)
    {
        $cat = Categorie::where('categories.id', $catID)
                        ->join('images', 'images.id', '=', 'categories.id_image')
                        ->select('categories.*', 'images.emplacement')->first();

        $catProducts = Product::where('categorie', $cat->nom)->get();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                ->select('categories.*', 'images.emplacement')->get();

        $current_promotions = MainController::getCurrentPromotions();

        $filter = $request->filter;

        switch($filter) {
            case '1': $catProducts = Product::join('promotions', 'promotions.id_article', '=', 'products.id')
                                            ->where('products.categorie', $cat->nom)
                                            ->select('products.*', 'promotions.nouveau_prix_vente')->get();
                break;
            case '2': $catProducts = Product::where('categorie', $cat->nom)->orderBy('prix_vente', 'desc')->get();
                break;
            case '3': $catProducts = Product::where('categorie', $cat->nom)->orderBy('prix_vente', 'asc')->get();
                break;
            case '4': $catProducts = Product::where('categorie', $cat->nom)->orderBy('prix_vente', 'desc')->get();
                break;
            case '5': $catProducts = Product::where('categorie', $cat->nom)->orderBy('prix_vente', 'desc')->get();
                break;
            default: $catProducts = Product::where('categorie', $cat->nom)->get();
        }

        return view('products.index')->with('catProducts', $catProducts)->with([
            'search'    => '',
            'filter'    => $filter,
            'categorie' => $cat,
            'categories' => $categories,
            'current_promotions' => $current_promotions,
        ]);
    }

    public function indexSearching(Request $request, $catID)
    {
        $search = $request->search;

        $cat = Categorie::where('categories.id', $catID)
                        ->join('images', 'images.id', '=', 'categories.id_image')
                        ->select('categories.*', 'images.emplacement')->first();

        $catProducts = Product::where('categorie', $cat->nom)
                        ->where('products.nom', 'like', '%'.$search.'%')->get();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                ->select('categories.*', 'images.emplacement')->get();

        $current_promotions = MainController::getCurrentPromotions();

        return view('products.index')->with('catProducts', $catProducts)->with([
            'filter'    => '',
            'search'    => $search,
            'categorie' => $cat,
            'categories' => $categories,
            'current_promotions' => $current_promotions,
        ]);
    }

    public function show(string $catID, string $productID) {

        $cat = Categorie::where('categories.id', $catID)
                        ->join('images', 'images.id', '=', 'categories.id_image')
                        ->select('categories.*', 'images.emplacement')->first();

        $catProducts = Product::where('categorie', $cat->nom)->get();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        $product = Product::findOrFail($productID);
        $current_promotions = MainController::getCurrentPromotions();

        return view('products.show', [
            'categories'  => $categories,
            'allProducts' => Product::all(),
            'categorie'   => $cat,
            'catProducts' => $catProducts,
            'product'     => $product,
            'current_promotions' => $current_promotions,
        ]);
    }
}
