<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Models\Admin;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Image;

use Illuminate\Database\Eloquent;
use DB;

class AuthenticationController extends Controller
{
    
    public function login(string $target) {

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();
    
        $top_featured = Product::orderBy('prix_achat', 'desc')->limit(4)->get();
        $randomProducts = DB::table('products')->inRandomOrder()->limit(4)->get();

        return view('auth.login', [
            'target' => $target,
            'categories' => $categories,
            'products'   => Product::all(),
            'randomProducts' => $randomProducts,
            'top_featured'  => $top_featured,
        ]);
    }

    public function hundleLogin(Request $request) {

        //Error messages
        $messages = [
            "email.required" => "L'email est obligatoire",
            "email.email" => "L'email n'est pas valide",
            "email.exists" => "L'email n'existe pas",
            "password.required" => "Le mot de passe est obligatoire",
            "password.min" => "Le mot de passe doit être au moins de 6 caractères"
        ];
        
        // validate the form data
        $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6'
            ], $messages);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password ], $request->remember)) {
                // if successful -> redirect forward
                $request->session()->regenerate();
                $userid = auth()->user()->id;
                session([ 'userid' => $userid ]);
                if(auth()->user()->role === 0) {
                    return redirect('admin');
                } else {
                    if( strip_tags($request->target) == 'order' ) {
                        return to_route('order');
                    }
                    return to_route('user.index', $userid);
                }
            } else {
                // if unsuccessful -> redirect back
                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                    'password' => 'Mot de passe incorrect.',
                ]);
            }
        }
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();    
        $request->session()->invalidate();    
        $request->session()->regenerateToken();
        return to_route('home.index');
    }

    public function sign(string $target) {

        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

        return view('auth.sign', [
            'target'     => $target,
            'categories' => $categories,
            'products'   => Product::all(),
            'provinces'  => MainController::getDzProvinces(),
        ]);
    }

    public function hundleSign(Request $request) {

        $validator = AuthenticationController::getSignValidator($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $nom      = strip_tags($request->nom);
            $prenom   = strip_tags($request->prenom);
            $date     = strip_tags($request->date);
            $adresse  = strip_tags($request->adresse);
            $wilaya   = strip_tags($request->wilaya);
            $email    = strip_tags($request->email);
            $tel      = strip_tags($request->tel);
            $username = strip_tags($request->username);
            $password = strip_tags($request->password);

            $provinces = AdminMainController::getDzProvinces();

            foreach($provinces as $province) {
                if( $province[2] == $wilaya ) {
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

            $user = User::create([
                'username' => $username,
                'email'    => $email,
                'password' => Hash::make($password),
                'role'     => 1,
            ]);
            $userID = $user->id;

            $client = Client::create([
                'nom'     => $nom,
                'prenom'  => $prenom,
                'date_naissance' => $date,
                'adresse' => $adresse,
                'email'   => $email,
                'tel'     => $tel,
                'userid'  => $userID,
            ]);


        
            return redirect()->route('login', [
                'target' => $request->target,
            ]);
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'unknown' => 'Erreur non reconnue!',
        ]);
    
    }

    public function signout(Request $request): RedirectResponse {
        Auth::logout();    
        $request->session()->invalidate();    
        $request->session()->regenerateToken();
        return to_route('home.index');
    }

    public static function getSignValidator(Request $request) {
        //Error messages
        $messages = [
            "nom.required" => "Le nom est obligatoire",

            "prenom.required" => "Le prénom est obligatoire",

            "date.required" => "La date de naissance est obligatoire",

            "adresse.required" => "L'adresse est obligatoire",

            "wilaya.required" => "Le champ Wilaya est obligatoire",

            "email.required" => "L'email est obligatoire",
            "email.email"    => "L'email n'est pas valide",
            "email.unique"   => "L'email existe déja",
            "newEmail.required" => "L'email est obligatoire",
            "newEmail.email"    => "L'email n'est pas valide",

            "tel.required" => "Le numéro de Téléphone est obligatoire",

            "username.required" => "Le nom d'utilisateur est obligatoire",
            "username.unique"   => "Le nom d'utilisateur existe déja",
            "newUsername.required" => "Le nom d'utilisateur est obligatoire",

            "password.required"  => "Le mot de passe est obligatoire",
            "password.confirmed" => "Les deux mots de passe ne sont pas identiques",
            "password.min"       => "Le mot de passe doit être au moins de 6 caractères",

            "password_confirmation.required" => "Vous devez confirmer votre mot de passe",

            /* "newPassword.confirmed" => "Les deux mots de passe ne sont pas identiques", */
            "newPassword.min" => "Le mot de passe doit être au moins de 6 caractères",

            /* "newPassword_confirmation.required" => "Vous devez confirmer votre mot de passe", */
        ];

        // validate the form data
        $validator = Validator::make($request->all(), [
            'nom'      => 'required',
            'prenom'   => 'required',
            'date'     => 'required',
            'adresse'  => 'required',
            'wilaya'   => 'required',
            'email'    => 'required|email|unique:users,email|unique:clients,email',            
            'tel'      => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            
        ], $messages);

        return $validator;
    }
}
