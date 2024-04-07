<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Image;
use App\Models\Promotion;

use Illuminate\Database\Eloquent;
use DB;

use Carbon\Carbon;

class MainController extends Controller
{
    public function index() {

        $top_featured = Product::orderBy('prix_achat', 'desc')->limit(4)->get();
        $randomProducts = DB::table('products')->inRandomOrder()->limit(4)->get();

        $current_promotions = MainController::getCurrentPromotions();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return view('home', [
            'search'             => '',
            'categories'         => $categories,
            'products'           => Product::all(),
            'randomProducts'     => $randomProducts,
            'top_featured'       => $top_featured,
            'current_promotions' => $current_promotions,
        ]);
    }

    public function search(Request $request) {

        $search = $request->homeSearch;

        $top_featured = Product::orderBy('prix_achat', 'desc')->limit(4)->get();
        $randomProducts = DB::table('products')->inRandomOrder()->limit(4)->get();

        $current_promotions = MainController::getCurrentPromotions();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        if( $search != '' ) {
            $products = Product::where('products.nom', 'like', '%'.$search.'%')->get();

            return view('search.index', [
                'search'             => $search,
                'categories'         => $categories,
                'products'           => $products,
                'randomProducts'     => $randomProducts,
                'top_featured'       => $top_featured,
                'current_promotions' => $current_promotions,
            ]);
        } else {
            return view('home', [
                'search'             => '',
                'categories'         => $categories,
                'products'           => Product::all(),
                'randomProducts'     => $randomProducts,
                'top_featured'       => $top_featured,
                'current_promotions' => $current_promotions,
            ]);
        }

    }

    public function contact() {

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        $randomProduct = DB::table('products')->inRandomOrder()->limit(1)->first();
        return view('about.contact', [
            'categories' => $categories,
            'products'   => Product::all(),
            'randomProduct' => $randomProduct,
        ]);
    }

    public function about() {

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();
        
        $randomProduct = DB::table('products')->inRandomOrder()->limit(1)->first();
        return view('about.about', [
            'categories' => $categories,
            'products'   => Product::all(),
            'randomProduct' => $randomProduct,
        ]);
    }

    public function services() {

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        $randomProduct = DB::table('products')->inRandomOrder()->limit(1)->first();
        return view('about.services', [
            'categories' => $categories,
            'products'   => Product::all(),
            'randomProduct' => $randomProduct,
        ]);
    }

    public static function createDirecrotory(string $path)
    {
        $public_path = public_path($path);

        if(!File::isDirectory($public_path)){
            File::makeDirectory($public_path, 0777, true, true);
        }
    }

    public static function renameDirecrotory(string $oldPath, string $newPath)
    {
        $old_public_path = public_path($oldPath);
        $new_public_path = public_path($newPath);

        if(File::isDirectory($old_public_path)){
            File::moveDirectory($old_public_path, $new_public_path);
        }
    }

    public static function getDzProvinces()
    {
        $provinces = [];

        if (($open = fopen(public_path("docs/provinces_wilaya_of_algeria.csv"), "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $provinces[] = $data;
            }

            fclose($open);
        }

        return $provinces;
    }

    public static function getCurrentPromotions() {
        $now_date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $promotions = Promotion::select('*')
                                ->join('products', 'products.id', '=', 'promotions.id_article')
                                ->orderBy('date_fin', 'desc')->get();

        $current_promotions = array();
        foreach($promotions as $promotion) {
            $date_promotion = Carbon::createFromFormat('Y-m-d', $promotion->date_fin);
            if( $date_promotion->gte($now_date) ) {
                array_push($current_promotions, $promotion);
            }
        }
        return $current_promotions;
    }
}
