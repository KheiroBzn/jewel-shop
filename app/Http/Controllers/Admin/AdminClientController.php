<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\ClientsDataTable;
use App\Http\Controllers\Admin\AdminMainController;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminClientController extends Controller
{
    public function index(Request $request)
    {
        $dataTable = new ClientsDataTable();
        return $dataTable->render('admin.clients.index', [
            'admin' => AdminMainController::admin(),
        ]);
    }

    public function create(Request $request) {
        return view('admin.clients.create', [
            'admin' => AdminMainController::admin(),
            'provinces' => AdminMainController::getDzProvinces(),
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'nom'      => 'required',
            'prenom'   => 'required',
            'date'     => 'required',
            'adresse'  => 'required',
            'wilaya'   => 'required',
            'email'    => 'required',
            'tel'      => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

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
                $wilaya = $province[1] . " - " . $wilaya;
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
      
        return redirect()->route('clients.index');
    }

    public function show(Client $client) {
        return view('admin.clients.show', [
            'admin' => AdminMainController::admin(),
            'client'     => $client,
            'clientUser' => User::where('id', $client->userid)->first(),
        ]);
    }

    public function edit(Client $client) {
        $provinces = AdminMainController::getDzProvinces();
        $wilaya = preg_split("/\s-\s/" ,preg_split ("/\s--\s/", $client->adresse)[1])[1];
        return view('admin.clients.edit', [
            'admin' => AdminMainController::admin(),
            'client'     => $client,
            'clientUser' => User::where('id', $client->userid)->first(),
            'wilaya'     => $wilaya,
            'provinces'  => $provinces,
        ]);
    }

    public function update(Request $request, Client $client) {

        $user = User::where('id', $client->userid)->first();
        $password = $user->password;
        if( !empty($request->newPassword) ) {
            $password = Hash::make($request->newPassword);
        }
        $client->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date,
            'email' => $request->email,
            'tel' => $request->tel,
            'updated_at' => now()
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $password,
            'updated_at' => now()
        ]);

        return to_route('clients.index');
    }

    public function destroy(string $clientID)
    {

        $client = Client::findOrFail($clientID);
        $user = User::findOrFail($client->userid);        
        $user->delete();
        $client->delete();

        return redirect()->route('clients.index');

    }
}
