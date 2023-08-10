<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Entity;
use App\Models\Image;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request  $request, Event $event = null){

        $validators = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|exists:entities,email',
            'password' => 'required|min:6',
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $data = $request->all();
        $entity = Entity::where('email', '=', $data['email'])->first();
        if($entity != null){

            if(password_verify($data['password'], $entity->password)){

                //if ($entity->is_active){
                    session()->put('user', collect([
                        'id' => $entity->entityable_id,
                        'name' => $entity->entityable_type === 'App\\Models\\Company'
                            ? Company::where('id', '=', $entity->entityable_id)->first()->name
                            : $entity->lastname . ' ' . $entity->firstname,
                        'picture' => Image::where('imageable_id', '=', $entity->entityable_id)->first()->url
                    ]));

                    return redirect()->route('home.page')->with('success', "Connexion réussie. Bienvenue !");
                //}else{
                    //return redirect()->route('login.page')->with('info', "Votre compte n'est pas actif. Veuillez vérifier votre boîte de réception pour activer votre compte en cliquant sur le lien d'activation qui vous a été envoyé par e-mail. Si vous avez des questions, veuillez contacter notre équipe d'assistance. Merci !")->withInput();
                //}

            }else{

                if ($event != null){
                    return redirect()->route('login.page', ['event' => $event->id])->with('error', "Les identifiants saisis sont incorrects.")->withInput();
                }
                return redirect()->route('login.page')->with('error', "Les identifiants saisis sont incorrects.")->withInput();
            }

        }else{
            if ($event != null){
                return redirect()->route('login.page', ['event' => $event->id])->with('error', "Les identifiants saisis sont incorrects.")->withInput();
            }
            return redirect()->route('login.page')->with('error', "Les identifiants saisis sont incorrects.")->withInput();
        }
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login.page');
    }

    /**
     * @param User $user
     * @param Event $event = null
     */
    public function activeAccount(User $user, Event $event = null){

        $user->is_active = true;
        if($user->save()){
            if ($event != null){
                return redirect()->route('login.page', ['event' => $event->id])->with('success', "Votre compte a été activé avec succès ! Vous pouvez maintenant vous connecter et profiter de toutes les fonctionnalités de notre site. Bienvenue !");
            }
            return redirect()->route('login.page')->with('success', "Votre compte a été activé avec succès ! Vous pouvez maintenant vous connecter et profiter de toutes les fonctionnalités de notre site. Bienvenue !");
        }else{
            return redirect()->route('home.page')->with('error', "Désolé, un problème est survenu lors de l'activation de votre compte. Veuillez contacter notre équipe d'assistance pour obtenir de l'aide. Nous nous excusons pour les désagréments occasionnés.");
        }
    }
}
