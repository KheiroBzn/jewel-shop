<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthenticationController;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Validator;
/* use Illuminate\Support\Facades\Auth; */
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\File as FileValidation;

use App\Models\Admin;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Image;
use App\Models\Order; 
use App\Models\OrderDetails; 
use App\Models\Invoice;  
use App\Models\Paymant;
use App\Models\CcpImage;  
use App\Models\Livraison;  

use PDF;

class ProfileController extends Controller
{
    public function index() {

        $user = auth()->user();
        $client = Client::where('userid', $user->id)->first();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        $orders = Order::where('id_client', $client->id)                                    
                                    ->join('invoices', 'invoices.id_commande', '=', 'orders.id')
                                    ->join('livraisons', 'livraisons.id_commande', '=', 'orders.id')
                                    ->get();

        return view('profile.index', [
            'user' => $user,
            'client' => $client,
            'categories' => $categories,
            'products'   => Product::all(),
            'orders'     => $orders,
        ]);
    }

    public function accountShow(User $user) {

        $user = auth()->user();
        $client = Client::where('userid', $user->id)->first();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return view('profile.accountShow', [
            'user' => $user,
            'client' => $client,
            'categories' => $categories,
            'products'   => Product::all(),
        ]);
    }

    public function accountEdit(User $user) {

        $user = auth()->user();
        $client = Client::where('userid', $user->id)->first();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        $wilaya = preg_split("/\s-\s/" ,preg_split ("/\s--\s/", $client->adresse)[1])[1];

        return view('profile.accountEdit', [
            'user'       => $user,
            'client'     => $client,
            'categories' => $categories,
            'products'   => Product::all(),
            'provinces'  => MainController::getDzProvinces(),
            'wilaya'     => $wilaya,
        ]);
    }

    public function accountUpdate(Request $request, User $user) {

        //$user = auth()->user();
        $client = Client::where('userid', $user->id)->first();

        $password = $user->password;
        $newPassword = strip_tags($request->password);

        if( isset($newPassword) and !empty($newPassword) ) {
            $password = Hash::make($newPassword);
        }

        $newEmail    = strip_tags($request->newEmail);
        $newUsername = strip_tags($request->newUsername);

        $newEmailCheck = User::where('email', $newEmail)->where('id', '!=', $user->id)->first();
        $newUsernameCheck = User::where('username', $newUsername)->where('id', '!=', $user->id)->first();

        $existNewEmail = ($newEmailCheck === null) ? false : true;
        $existNewUsername = ($newUsernameCheck === null) ? false : true;

        $validator = ProfileController::getAccountUpdateValidator($request);

        if( !$existNewEmail and !$existNewUsername ) {
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $nom      = strip_tags($request->nom);
                $prenom   = strip_tags($request->prenom);
                $date     = strip_tags($request->date);
                $adresse  = strip_tags($request->adresse);
                $wilaya   = strip_tags($request->wilaya);
                $newEmail = strip_tags($request->newEmail);
                $tel      = strip_tags($request->tel);
                $newUsername = strip_tags($request->newUsername);
    
                $provinces = MainController::getDzProvinces();
    
                foreach($provinces as $province) {
                    if( $province[0] == $wilaya ) {
                        $wilaya = $province[1] . " - " . $province[2];
                        break;
                    }
                }
    
                $adresse = $adresse . " -- " . $wilaya;
                $date = strtotime($date);
    
                if (isset($date)) {
                    $date = date('Y-m-d', $date);
                } else {
                    $date = null;
                }
    
                $user->update([
                    'username' => $newUsername,
                    'email'    => $newEmail,
                    'password' => Hash::make($password),
                    'updated_at' => now(),
                ]);
    
                $client->update([
                    'nom'     => $nom,
                    'prenom'  => $prenom,
                    'date_naissance' => $date,
                    'adresse' => $adresse,
                    'email'   => $newEmail,
                    'tel'     => $tel,
                    'updated_at' => now(),
                ]);
            
                return redirect()->route('user.index', $user);
            }

            return redirect()->back()->withInput($request->only('newEmail'))->withErrors([
                'unknown' => 'Erreur non reconnue!',
            ]);
        } else {
            if( $existNewEmail ) {
                if( $existNewUsername ) {
                    return redirect()->back()->withInput($request->only('newEmail'))->withErrors([
                        'newEmail' => 'Email existe déja',
                        'newUsername' => 'Nom utilisateur existe déja',
                    ]);
                } else {
                    return redirect()->back()->withInput($request->only('newEmail'))->withErrors([
                        'newEmail' => 'Email existe déja',
                    ]);
                }
            } elseif( $existNewUsername ) {
                return redirect()->back()->withInput($request->only('newEmail'))->withErrors([
                    'newUsername' => 'Nom utilisateur existe déja',
                ]);
            } else {
                return redirect()->back()->withInput($request->only('newEmail'))->withErrors([
                    'unknown' => 'Erreur non reconnue!',
                ]);
            }            
        }
    }

    public function ordersShow() {

        $user = auth()->user();
        $client = Client::where('userid', $user->id)->first();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        $orders = Order::where('id_client', $client->id)                                    
                                    ->join('invoices', 'invoices.id_commande', '=', 'orders.id')
                                    ->join('livraisons', 'livraisons.id_commande', '=', 'orders.id')
                                    ->get();

        return view('profile.index', [
            'user' => $user,
            'client' => $client,
            'categories' => $categories,
            'products'   => Product::all(),
            'orders'     => $orders,
        ]);
    }

    public function orderPay($client, $order) {

        $ord = Order::findOrFail($order);

        $orderDetails = OrderDetails::where('id_commande', $order)
                                    ->join('products', 'products.id', '=', 'order_details.id_bijou')
                                    ->get();

        $invoice = Invoice::where('id_commande', $order)->first();

        $user = auth()->user();
        $client = Client::where('userid', $user->id)->first();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return view('profile.paymant', [
            'admin'        => AdminMainController::admin(),
            'order'        => $ord,
            'orderDetails' => $orderDetails,
            'invoice'      => $invoice,
            'client'       => $client,
            'user'         => $user,
            'categories'   => $categories,
        ]);
    }

    public function hundlePay(Request $request, $client, $order) {

        $user = auth()->user();
        $client = Client::where('userid', $user->id)->first();
        $cmd = Order::findOrFail($order);

        $request->validate([
            'image'      => 'required',
        ]);
        
        $paymant = Paymant::create([
            'etat'         => 'verification',
            'ccp'          => '0000NOTRECCP00',
            'total'        => $cmd->total,
            'id_commande'  => $cmd->id,
            'id_client'    => $client->id,
            'id_image'     => '',
        ]);

        $paymantID = $paymant->id;

        $path = 'images/jewelry/ccp/client_'.$client->id;
        MainController::createDirecrotory($path);

        $image = $request->image;

        $extension = $image->extension();
        $imageName = 'CMD'.$cmd->id.'C'.$client->id.'P'.$paymantID.'.'.$extension;            
        $image->move(public_path($path), $imageName);

        $imageDB = new CcpImage();
        $imageDB->nom = $imageName;
        $imageDB->emplacement = $path;
        $imageDB->extention   = $extension;
        $imageDB->id_commande = $cmd->id;
        $imageDB->id_client   = $client->id;
        $imageDB->id_paiement = $paymantID;
        $imageDB->save();

        $paymant->id_image = $imageDB->id;
        $paymant->save();

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return to_route('user.index', $user->id)->with([
            'client'     => $client,
            'categories' => $categories,
            'products'   => Product::all(),
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

        $pdf = PDF::loadView('profile.invoice', [
            'invoice' => $invoice,
            'order' => $order,
            'orderDetails' => $orderDetails,
            'livraison' => $livraison,
            'client' => $client,
        ]);

        $invoice = Invoice::findOrFail($id);
        

        return $pdf->download($invoice->reference.'.pdf');
    }

    public static function getAccountUpdateValidator(Request $request) {
        //Error messages
        $messages = [
            "nom.required"         => "Le nom est obligatoire",
            "prenom.required"      => "Le prénom est obligatoire",
            "date.required"        => "La date de naissance est obligatoire",
            "adresse.required"     => "L'adresse est obligatoire",
            "wilaya.required"      => "Le champ Wilaya est obligatoire",
            "newEmail.required"    => "L'email est obligatoire",
            "newEmail.email"       => "L'email n'est pas valide",
            "tel.required"         => "Le numéro de Téléphone est obligatoire",
            "newUsername.required" => "Le nom d'utilisateur est obligatoire",
            "newPassword.min"      => "Le mot de passe doit être au moins de 6 caractères",
        ];

        // validate the form data
        $validator = Validator::make($request->all(), [
            'nom'         => 'required',
            'prenom'      => 'required',
            'date'        => 'required',
            'adresse'     => 'required',
            'wilaya'      => 'required',
            'newEmail'    => 'required|email',            
            'tel'         => 'required',
            'newUsername' => 'required',
            'newPassword' => 'min:6',
            
        ], $messages);

        return $validator;
    }
}
