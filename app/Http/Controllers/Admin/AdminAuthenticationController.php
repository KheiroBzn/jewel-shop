<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent;
use DB;

class AdminAuthenticationController extends Controller
{

    public function index(Request $request) {
        return view('admin.profile.index', [ 
            'admin' => AdminMainController::admin(),
            'user'  => auth()->user(),
        ]);
    }

    public function edit(Admin $admin) {

        $user = User::where('id', $admin->userid)->first();
        return view('admin.profile.edit', [ 
            'admin' => $admin,
            'user'  => auth()->user(),
        ]);
    }

    public function update(Admin $admin, Request $request)
    {   
        $user = User::where('id', $admin->userid)->first();

        $newEmail    = strip_tags($request->newEmail);
        $newUsername = strip_tags($request->newUsername);

        $newEmailCheck = User::where('email', $newEmail)->where('id', '!=', $user->id)->first();
        $newUsernameCheck = User::where('username', $newUsername)->where('id', '!=', $user->id)->first();

        $existNewEmail = ($newEmailCheck === null) ? false : true;
        $existNewUsername = ($newUsernameCheck === null) ? false : true;

        if( !$existNewEmail and !$existNewUsername ) {
            $request->validate([
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'tel' => 'required|numeric',
            ]);

            $password = $user->password;
            if( !empty($request->newPassword) ) {
                $password = Hash::make($request->newPassword);
            }
    
            $admin->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->newEmail,
                'tel' => $request->tel,
                'updated_at' => now()
            ]);
    
            $user->update([
                'username' => $request->newUsername,
                'email' => $request->newEmail,
                'password' => $password,
                'updated_at' => now()
            ]);
    
            return to_route('profile.index');

        } elseif( $existNewEmail ) {
            return redirect()->back()->withInput($request->only('newEmail'))->withErrors([
                'newEmail' => 'Email existe déja',
            ]);
        } else {
            return redirect()->back()->withInput($request->only('newEmail'))->withErrors([
                'newUsername' => 'Nom utilisateur existe déja',
            ]);
        }        
    }

    public function create() {

        $user = auth()->user();
        $admin = Admin::where('userid', $user->id)->first();
        return view('admin.profile.create', [ 
            'admin' => $admin,
            'user'  => $user,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|max:250|unique:users',
            'username' => 'required|max:250|unique:users',
            'tel' => 'required|numeric',
            'password' => 'required|min:6|'
        ]);

        $user = User::create([            
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 0,
        ]);

        $userID = $user->id;

        Admin::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'tel' => $request->tel,
            'userid' => $userID,
        ]);

        return to_route('profile.index');
    }
    
    public function login() {
    
        return view('admin/authentication/login', [
            'title' => 'Connexion', 
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
                if(auth()->user()->role === 0) {
                    $request->session()->regenerate();
                    $userid = auth()->user()->id;
                    session([ 'userid' => $userid ]);
                    return redirect('admin');
                }
            }
    
            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'password' => 'Mot de passe incorrect.',
            ]);
        }
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();    
        $request->session()->invalidate();    
        $request->session()->regenerateToken();
        return to_route('home.index');
    }
}
