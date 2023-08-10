<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Company;
use App\Models\Entity;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'lastname' => 'required|min:3',
            'firstname' => 'required|min:3',
            'gender_id' => 'required|numeric|min:1|max:2',
            'phone' => 'required',
            'email' => 'required|email:rfc,dns',
            'name' => 'required|min:3|unique:companies',
            'password' => 'required|min:6|required_with:password_confirmation|confirmed',
            'password_confirmation' => 'required|min:6|same:password_confirmation',
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $password_hash = password_hash($request->input('password'), PASSWORD_DEFAULT);

        $company = new Company();
        $company->id = (string) Str::uuid();
        $company->name = $request->input('name');
        if($company->save() !== null){

            $entity = new Entity();
            $entity->id = (string) Str::uuid();
            $entity->lastname = $request->input('lastname');
            $entity->firstname = $request->input('firstname');
            $entity->gender_id = $request->input('gender_id');
            $entity->phone = $request->input('phone');
            $entity->email = $request->input('email');
            $entity->password = $password_hash;

            if($company->entity()->save($entity)){
                dump('entity create');
            }
            session()->put('user', collect([
                'id' => $company->id,
                'name' => $company->name
            ]));
            return redirect()->route('accountCompany.page', $company->id)->with('success', "Félicitations pour la création de votre compte Entreprise ! Veuillez consulter votre boîte de réception et activer votre compte en cliquant sur le lien d'activation qui vous a été envoyé par e-mail. Profitez de toutes les fonctionnalités de notre site une fois votre compte activé. Bienvenue parmi nous !");
        }else{
            dd('erreur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //dd($company, $request->all());
        $updatedRows = Entity::where('entityable_id', $company->id)->update([
            'lastname' => $request->input('lastname'),
            'firstname' => $request->input('firstname'),
            'gender_id' => $request->input('gender_id'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'country_id' => $request->input('country_id'),
            'city_id' => $request->input('city_id'),
            // ... autres colonnes à mettre à jour
        ]);

        $company->name = $request->input('name');
        $company->sector_id = $request->input('sector_id');

        if($updatedRows && $company->save()){
            return redirect()->back()->with('success', 'Vos informations ont été mise à jour');
        }else{
            return redirect()->back()->with('error', 'Impossible de mettre à jour vos informations');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadLogo(Request $request){
        if ($request->logo->isValid()) {
            $company = Company::find(session()->get('user')['id']);

            if (!$company) {
                return response()->json(['message' => 'Impossible de trouver l\'entreprise correspondante', 'code' => 1]);
            }

            // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
            $image = $company->image;

            if ($image) {
                // Si l'image existe déjà, mettez à jour le champ "url"
                $this->deleteImage($image->url); // Supprime l'ancienne image si nécessaire
                $image->url = $this->moveImage($request->logo); // Met à jour le champ "url"
                $image->save();
            }else {
                // Si l'image n'existe pas, créez un nouvel enregistrement dans la table "images"
                $image = new Image();
                $image->id = (string) Str::uuid();
                $image->url = $this->moveImage($request->logo); // Enregistre la nouvelle image
                $company->image()->save($image);
            }

            $user = session()->get('user');
            $user['picture'] = $image->url;
            session(['user' => $user]);

            return response()->json(['message' => 'Votre logo a bien été mis à jour', 'code' => 0]);
        }
        return response()->json(['message' => 'Aucune image trouvée.', 'code' => 1]);
    }
    /*public function uploadLogo(Request $request){
        if ($request->logo->isValid()){

            $currentDateTime = Carbon::now();
            $formattedDateTime = $currentDateTime->format('Ymd_His');

            $path_logo = $formattedDateTime . '.' . $request->logo->getClientOriginalExtension();

            $request->logo->move(public_path('assets/img/logo'), $path_logo);

            $image = new Image();
            $image->id = (string) Str::uuid();
            $image->url = "assets/img/logo/" . $path_logo;

            $company = Company::find(session()->get('user')['id']);
            if($company->image()->save($image)){
                return response()->json(['message' => 'Votre logo a bien été mise à jour', 'code' => 0]);
            }else{
                return response()->json(['message' => 'Impossible de mettre à jour votre logo', 'code' => 1]);
            }
        }
    }*/

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addAbout(Request $request){

        $validators = Validator::make($request->all(), [
            'website' => 'required|url',
            'link_fb' => 'required|url',
            'link_in' => 'required|url',
            'content' => 'required|min:6',
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $company = Company::find(session()->get('user')['id']);

        $aboutData = [
            'id' => (string) Str::uuid(),
            'website' => $request->input('website'),
            'link_fb' => $request->input('link_fb'),
            'link_in' => $request->input('link_in'),
            'content' => $request->input('content'),
        ];

        $about = $company->about()->updateOrCreate(['aboutable_id' => $company->id], $aboutData);
        if ($about) {
            // Succès : L'enregistrement a été mis à jour ou créé avec succès
            // Vous pouvez maintenant utiliser $about si nécessaire
            return back()->with('success', "Mise à jour de la présentation réussie");
        } else {
            // Échec : Il y a eu un problème lors de la mise à jour ou de la création
            return back()->withErrors(['erreur'])->withInput();
        }
        /*$about = new About();
        $about->id = (string) Str::uuid();
        $about->website = $request->input('website');
        $about->link_fb = $request->input('link_fb');
        $about->link_in = $request->input('link_in');
        $about->content = $request->input('content');

        $company = Company::find(session()->get('user')['id']);
        if($company->about()->save($about)){
            return redirect()->route('accountCompany.page')->with('success', "Mise à jour de la présentation réussit");
        }

        return back()->withErrors(['erreur'])->withInput();*/
    }

    // Méthode pour déplacer l'image et retourner l'URL de l'image déplacée
    private function moveImage($file)
    {
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('Ymd_His');

        $path_logo = $formattedDateTime . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img/logo'), $path_logo);

        return "assets/img/logo/" . $path_logo;
    }

    // Méthode pour supprimer une image
    private function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
