<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Promotion;
use App\Models\Categorie;
use App\Models\Image;
use App\DataTables\ProductsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\File as FileValidation;
use Yajra\DataTables\Facades\DataTables;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categorie::all();
        $products = Product::all();
        $productsIDs = array();

        foreach( $products as $product ) {
            array_push($productsIDs, $product->id);
        }

        $dataTable = new ProductsDataTable($productsIDs);

        return $dataTable->render('admin.products.index', [
            'admin' => AdminMainController::admin(),
            'categories' => $categories,
        ]);
    }

    public function filteredByCategory(Categorie $categorie)
    {
        $products = Product::where('categorie', $categorie->nom)->get();
        $tableTitle = 'Liste de produits : '.$categorie->nom;

        return AdminProductController::hudleFilter($products, $tableTitle);
        
    }

    public function filteredBySupplier(Supplier $supplier)
    {
        $products = Product::where('id_fournisseur', $supplier->id)->get();
        $tableTitle = 'Liste de produit fournis par : '.$supplier->nom;

        return AdminProductController::hudleFilter($products, $tableTitle);
        
    }

    public static function hudleFilter($products, string $tableTitle) {

        $productsIDs = array();
        foreach( $products as $product ) {
            array_push($productsIDs, $product->id);
        }

        $dataTable = new ProductsDataTable($productsIDs);

        return $dataTable->render('admin.products.filtered', [
            'admin' => AdminMainController::admin(),
            'tableTitle' => $tableTitle,
        ]);
    }

    public function create(Request $request) {
        $categories = Categorie::all();
        $suppliers = Supplier::all();
        return view('admin.products.create', [
            'admin'      => AdminMainController::admin(),
            'categories' => $categories,
            'suppliers'  => $suppliers,
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.products.add', [
            'admin' => AdminMainController::admin(),
            'products' => Product::all(),
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'nom'         => 'required',
            'prix_achat'  => 'required',
            'prix_vente'  => 'required',
            'categorie'   => 'required',
            'type'        => 'required',
            'fournisseur' => 'required',
            'stock'       => 'required',
            'image1'      => ['required', FileValidation::image()->types(['jpg'])],
            'image2'      => ['required', FileValidation::image()->types(['jpg'])],
            'image3'      => ['required', FileValidation::image()->types(['jpg'])],
        ]);

        $nom         = strip_tags($request->nom);
        $prix_achat  = strip_tags($request->prix_achat);
        $prix_vente  = strip_tags($request->prix_vente);
        $description = strip_tags($request->description);
        $categorie   = strip_tags($request->categorie);
        $type        = strip_tags($request->type);
        $fournisseur = strip_tags($request->fournisseur);
        $stock       = strip_tags($request->stock);
        
        if(empty($description)) {
            $description = $nom.' | '.$categorie.' | '.$type;
        }

        $product = Product::create([
            'nom'         => $nom,
            'prix_achat'  => $prix_achat,
            'prix_vente'  => $prix_vente,
            'description' => $description,
            'categorie'   => $categorie,
            'id_fournisseur' => $fournisseur,
            'type'        => $type,
            'stock'       => $stock,
            'images'      => $nom,
        ]);
        
        $productID = $product->id;

        $typeP = $type == 'Blanc' ? 'B' : 'N';
        $cat = Categorie::where('nom', $categorie)->first();
        $id_product = 'F'.$fournisseur.'P'.$productID.'C'.$cat->id.'T'.$typeP;

        $product->id_product = $id_product;

        $product->save();

        $path = 'images/jewelry/'.$product->categorie.'/'.$product->nom;

        AdminMainController::createDirecrotory($path);

        $images = [ $request->image1, $request->image2, $request->image3 ];
        $imageIndex = 1;

        foreach( $images as $image ) {
            $extension = $image->extension();
            $imageName = $request->nom.' img'.$imageIndex.'.'.$extension;            
            $image->move(public_path($path), $imageName);

            $imageDB = new Image();
            $imageDB->nom = $imageName;
            $imageDB->emplacement = $path;
            $imageDB->id_product = $productID;
            $imageDB->type_image = 'product';
            $imageDB->save();
            $imageIndex++;
        }        
        return redirect()->route('products.index');
    }

    public function reStore(Request $request) {

        $request->validate([
            'product' => 'required',
            'qte'     => 'required|numeric',
        ]);

        $productID = strip_tags($request->product);
        $qte       = strip_tags($request->qte);

        $product = Product::findOrFail($productID);

        $product->stock = $product->stock + intval($qte);
        $product->updated_at = now();
        $product->save();

        return redirect()->route('products.index');
    }

    public function show(Product $product) {
        $categories = Categorie::all();
        $images = Image::where('id_product', $product->id)
                        ->orderBy('id', 'asc')->limit(3)->get();
        $supplier = Supplier::where('id', $product->id_fournisseur)->first();

        $current_promotions = AdminMainController::getCurrentPromotions();
        $promotion = new Promotion();

        foreach($current_promotions as $promo) {
            if( $promo->id_article == $product->id ) {
                $promotion = $promo;
                break;
            }
        }
        
        return view('admin.products.show', [
            'admin'      => AdminMainController::admin(),
            'product'    => $product,
            'categories' => $categories,
            'images'     => $images,
            'supplier'   => $supplier,
            'promotion'  => $promotion,
        ]);
    }

    public function edit(Product $product) {
        $categories = Categorie::all();
        $suppliers = Supplier::all();
        $images = Image::where('id_product', $product->id)->get();
        return view('admin.products.edit', [
            'admin'      => AdminMainController::admin(),
            'product'    => $product,
            'categories' => $categories,
            'suppliers'  => $suppliers,
            'images'     => $images,
        ]);
    }

    public function update(Request $request, string $productID) {
        $request->validate([
            'nom'         => 'required',
            'prix_achat'  => ['required', 'integer'],
            'prix_vente'  => ['required', 'integer'],
            'description' => 'required',
            'categorie'   => 'required',
            'type'        => 'required',
            'fournisseur' => 'required',
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
        $fournisseur = strip_tags($request->fournisseur);
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
        $product->id_fournisseur = $fournisseur;
        $product->save();

        $typeP = $type == 'Blanc' ? 'B' : 'N';
        $cat = Categorie::where('nom', $categorie)->first();
        $id_product = 'F'.$fournisseur.'P'.$productID.'C'.$cat->id.'T'.$typeP;

        $product->id_product = $id_product;

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
        return redirect()->route('products.index');
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

        return redirect()->route('products.index');
    }
}
