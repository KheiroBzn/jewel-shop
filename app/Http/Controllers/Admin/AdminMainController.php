<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Categorie;
use App\Models\Image;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use DB;

class AdminMainController extends Controller
{
    public function index(Request $request) {
        $products = Product::orderBy('prix_achat', 'desc')->limit(10)->get();
        $randomProduct = DB::table('products')->inRandomOrder()->limit(1)->first();
        $randomProductImage = Image::where('id_product', $randomProduct->id)->first();

        $clients = Client::all()->count();
        $validOrders = Order::where('etat', 'validee')->count();
        $pendingOrders = Order::where('etat', 'en_attente')->count();
        $doneOrders = Order::where('etat', 'livree')->count();

        return view('admin.home', [ 
            'admin' => AdminMainController::admin(),
            'products' => $products,
            'randomProduct' => $randomProduct,
            'randomProductImage' => $randomProductImage,
            'categories' => Categorie::all(),
            'clients' => $clients,
            'validOrders' => $validOrders,
            'pendingOrders' => $pendingOrders,
            'doneOrders' => $doneOrders,
        ]);
    }

    public static function admin() {
        return Admin::where('userid', session('userid'))->first();
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
        $promotions = Promotion::all();

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
