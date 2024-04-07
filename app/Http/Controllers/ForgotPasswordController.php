<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use App\Models\Product;
use App\Models\Categorie;

use Mail; 
use Hash;
use Illuminate\Support\Str;
  
class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm(string $target)
      {
        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

         return view('auth.forgetPassword', [
            'target' => $target,
            'categories' => $categories,
            'products'   => Product::all(),
         ]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_reset_tokens')->insert([
              'email' => $request->email, 
              'token' => $token,
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.forgetPassword', ['target' => $request->target, 'token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Réinitialiser le mot de passe');
          });
  
          return back()->with('message', 'Nous avons envoyé votre lien de réinitialisation de mot de passe par e-mail !');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($target, $token) 
      { 
        $categories = Categorie::join('images', 'images.id', '=', 'categories.id_image')
                                ->select('categories.*', 'images.emplacement')->get();

         return view('auth.forgetPasswordLink', [
            'target' => $target,
            'token' => $token,
            'categories' => $categories,
        ]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_reset_tokens')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Jeton invalide!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
  
          return to_route('login', ['target' => $request->target,])->with('message', 'Votre mot de passe a été changé!');
      }
}