<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use App\DataTables\SuppliesDataTable;
use App\DataTables\ProductsDataTable;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Supply;
use Illuminate\Http\Request;

class AdminSupplyController extends Controller
{
    public function index(Request $request)
    {

        $dataTable = new SuppliesDataTable();
        return $dataTable->render('admin.supply.index', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function show($id)
    {
        $supply = Supply::findOrFail($id);

        return view('admin.supply.show', [
            'admin' => AdminMainController::admin(),
            'supply' => $supply,
            'supplier' => Supplier::findOrFail($supply->id_fournisseur),
            'product' => Product::findOrFail($supply->id_produit),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.supply.create', [
            'admin' => AdminMainController::admin(),
            'categories' => Categorie::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.supply.add', [
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
        return redirect()->route('supply.index');
    }

    public function reStore(Request $request) {

        $request->validate([
            'product' => 'required',
            'qte'     => 'required',
        ]);

        $productID = strip_tags($request->product);
        $qte       = strip_tags($request->qte);

        $product = Product::findOrFail($productID);

        $product->stock = $product->stock + intval($qte);
        $product->updated_at = now();
        $product->save();

        return redirect()->route('supply.index');
    }
}
