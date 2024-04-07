<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    public function index(string $catID) {

        /* $cat = Categorie::findOrFail($catID); */

        $cat = Categorie::where('categories.id', $catID)
                        ->join('images', 'images.id', '=', 'categories.id_image')
                        ->select('categories.*', 'images.emplacement')->first();

        $catProducts = Product::where('categorie', $cat->nom)->get();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return view('categories.index', [
            'categories'  => $categories,
            'allProducts' => Product::all(),
            'categorie'   => $cat,
            'catProducts' => $catProducts,
        ]);
    }
}
