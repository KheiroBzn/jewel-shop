<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Promotion;
use App\Models\Image;
use App\DataTables\PromotionsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\TableModels\ProductsTable;
use SingleQuote\DataTables\DataTable;

class AdminPromotionController extends Controller
{
    public function index(Request $request)
    {
        $dataTable = new PromotionsDataTable();
        return $dataTable->render('admin.promotions.index', [
            'admin'    => AdminMainController::admin(),
        ]);
    }

    public function create(Request $request) {
        return view('admin.promotions.create', [
            'admin'    => AdminMainController::admin(),
            'products' => Product::all(),
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'product_promotion' => 'required',
            'reduction'         => 'required|min:0|max:100',
            'date_debut'        => 'required',
            'date_fin'          => 'required',
            'image'             => 'required',
        ]);

        $product_promotion = strip_tags($request->product_promotion);
        $reduction  = intval(strip_tags($request->reduction));
        $date_debut  = strip_tags($request->date_debut);
        $date_fin = strip_tags($request->date_fin);
        $image   = $request->image;

        $productID = intval(preg_split('/-/', $product_promotion)[0]);
        $product = Product::where('id', $productID)->first();

        $prix_achat = $product->prix_achat;
        $ancien_prix_vente = $product->prix_vente;
        $nouveau_prix_vente = $ancien_prix_vente - $ancien_prix_vente * $reduction / 100;

        $date_debut = strtotime($date_debut);
        $date_debut = isset($date_debut) ? date('Y-m-d', $date_debut) : null;

        $date_fin = strtotime($date_fin);
        $date_fin = isset($date_fin) ? date('Y-m-d', $date_fin) : null;

        $extension = $image->extension();
        $imageName = $date_debut.'_'.$product->nom.'.'.$extension;   
        $path = 'images/jewelry/promotions/'.$product->nom.'/'.$date_debut.' - '.$product->nom;

        AdminMainController::createDirecrotory($path);     
        $image->move(public_path($path), $imageName);
        
        $imageDB = new Image();
        $imageDB->nom = $imageName;
        $imageDB->emplacement = $path;
        $imageDB->id_product = $productID;
        $imageDB->save();     
        $imagetID = $imageDB->id;

        $promotion = new Promotion();
        $promotion->reduction          = $reduction;
        $promotion->date_debut         = $date_debut;
        $promotion->date_fin           = $date_fin;
        $promotion->prix_achat         = $prix_achat;
        $promotion->ancien_prix_vente  = $ancien_prix_vente;
        $promotion->nouveau_prix_vente = $nouveau_prix_vente;
        $promotion->id_article         = $productID;
        $promotion->id_image           = $imagetID;
        $promotion->save();     

        return redirect()->route('promotions.index');
    }

    public function show(Product $product) {
        $categories = Categorie::all();
        $images = Image::where('id_product', $product->id)->get();
        return view('admin.promotions.show', [
            'admin'    => AdminMainController::admin(),
            'product' => $product,
            'categories' => $categories,
            'images' => $images,
        ]);
    }

    public function edit(Product $product) {
        $categories = Categorie::all();
        $images = Image::where('id_product', $product->id)->get();
        return view('admin.promotions.edit', [
            'admin'    => AdminMainController::admin(),
            'product' => $product,
            'categories' => $categories,
            'images' => $images,
        ]);
    }

    public function update(Request $request, string $productID) {
        $request->validate([
            'nom'         => 'required',
            'prix_achat'  => ['required', 'integer'],
            'prix_vente'  => ['required', 'integer'],
            'description' => 'required',
            'categorie'   => 'required',
            'stock'       => ['required', 'integer'],
        ]);

        $product = Product::findOrFail($productID);

        $oldProductName = $product->nom;
        $oldProductCategorie = $product->categorie;
        $oldProductDescription = $product->description;

        $nom         = strip_tags($request->nom);
        $prix_achat  = strip_tags($request->prix_achat);
        $prix_vente  = strip_tags($request->prix_vente);
        $description = strip_tags($request->description);
        $categorie   = strip_tags($request->categorie);
        $type        = strip_tags($request->type);
        $stock       = strip_tags($request->stock);
        $images      = strip_tags($request->nom);

        if( $description != $oldProductDescription ) {
            $description = $description;
        } else {
            $description = $nom.' | '.$categorie.' | '.$type;
        }

        $product->nom         = $nom;
        $product->prix_achat  = $prix_achat;
        $product->prix_vente  = $prix_vente;
        $product->description = $description;
        $product->categorie   = $categorie;
        $product->type        = $type;
        $product->stock       = $stock;
        $product->images      = $nom;

        $product->save();

        if( $product->nom != $oldProductName or $product->categorie != $oldProductCategorie ) {
            $oldPath = 'images/jewelry/'.$oldProductCategorie.'/'.$oldProductName;
            $newPath = 'images/jewelry/'.$product->categorie.'/'.$product->nom;
            AdminMainController::renameDirecrotory($oldPath, $newPath);

            $i = 1;
            $images = Image::where('id_product', $product->id)->get();
            foreach($images as $image) {

                $infoPath = pathinfo(public_path($oldPath.'/'.$image->nom));  
                $extension = $infoPath['extension'];
                $newName = $product->nom.' img'.$i.'.'.$extension;
                File::move(public_path($newPath.'/'.$image->nom), public_path($newPath.'/'.$newName)); 
                $image->nom = $newName;
                $image->emplacement = $newPath;
                $image->save();
                $i = $i + 1;
            }
        }

        return redirect()->route('promotions.index');
    }

    public function destroy(string $productID)
    {

        
        $product = Product::findOrFail($productID);

        $images = Image::where('id_product', $productID)->get();
        foreach($images as $image) {
            $image->delete();
        }

        $path = 'images/jewelry/'.$product->categorie.'/'.$product->nom;
        File::deleteDirectory($path);
        $product->delete();

        return redirect()->route('promotions.index');

    }
}
