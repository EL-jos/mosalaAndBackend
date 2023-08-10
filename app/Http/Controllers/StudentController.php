<?php

namespace App\Http\Controllers;

use App\Models\Bac;
use App\Models\Company;
use App\Models\Daily;
use App\Models\Day;
use App\Models\Entity;
use App\Models\Formation;
use App\Models\Image;
use App\Models\Periodical;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
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
            'birth' => 'required|date',
            'password' => 'required|min:6|required_with:password_confirmation|confirmed',
            'password_confirmation' => 'required|min:6|same:password_confirmation',
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $password_hash = password_hash($request->input('password'), PASSWORD_DEFAULT);

        $student = new Student();
        $student->id = (string) Str::uuid();
        $student->birth = $request->input('birth');
        if($student->save() !== null){

            $entity = new Entity();
            $entity->id = (string) Str::uuid();
            $entity->lastname = $request->input('lastname');
            $entity->firstname = $request->input('firstname');
            $entity->gender_id = $request->input('gender_id');
            $entity->phone = $request->input('phone');
            $entity->email = $request->input('email');
            $entity->password = $password_hash;

            if($student->entity()->save($entity)){
                session()->put('user', collect([
                    'id' => $student->id,
                    'name' => $entity->lastname . ' ' . $entity->firstname
                ]));

                return redirect()->route('accountStudent.page', $student->id)->with('success', "Félicitations pour la création de votre compte Etudiant ! Veuillez consulter votre boîte de réception et activer votre compte en cliquant sur le lien d'activation qui vous a été envoyé par e-mail. Profitez de toutes les fonctionnalités de notre site une fois votre compte activé. Bienvenue parmi nous !");
            }else{
                $student->delete();
                dd('ERRUR');
            }

        }else{
            dd('erreur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('student', [
            'student' => $student,
            'days' => Day::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Request $request)
    {
        return view('new-request', [
            'request' => $request
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //dd($student);
        $updatedRows = Entity::where('entityable_id', $student->id)->update([
            'lastname' => $request->input('lastname'),
            'firstname' => $request->input('firstname'),
            'gender_id' => $request->input('gender_id'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'country_id' => $request->input('country_id'),
            'city_id' => $request->input('city_id'),
            // ... autres colonnes à mettre à jour
        ]);

        $student->birth = $request->input('birth');

        if($updatedRows && $student->save()){
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
    public function uploadPhoto(Request $request){
        if ($request->photo->isValid()) {
            $student = Student::find(session()->get('user')['id']);

            if (!$student) {
                return response()->json(['message' => 'Impossible de trouver l\'etudiant correspondant', 'code' => 1]);
            }

            // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
            $image = $student->image;

            if ($image) {
                // Si l'image existe déjà, mettez à jour le champ "url"
                $this->deleteImage($image->url); // Supprime l'ancienne image si nécessaire
                $image->url = $this->moveImage($request->photo, true); // Met à jour le champ "url"
                $image->save();
            }else {
                // Si l'image n'existe pas, créez un nouvel enregistrement dans la table "images"
                $image = new Image();
                $image->id = (string) Str::uuid();
                $image->url = $this->moveImage($request->photo, true); // Enregistre la nouvelle image
                $student->image()->save($image);
            }

            $user = session()->get('user');
            $user['picture'] = $image->url;
            session(['user' => $user]);

            return response()->json(['message' => 'Votre photo a bien été mis à jour', 'code' => 0]);
        }
        return response()->json(['message' => 'Aucune image trouvée.', 'code' => 1]);
    }

    // Méthode pour déplacer l'image et retourner l'URL de l'image déplacée
    private function moveImage($file, bool $is_picture)
    {
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('Ymd_His');

        $path_photo = $formattedDateTime . '.' . $file->getClientOriginalExtension();
        $file->move(public_path( $is_picture ? 'assets/img/photo/' : 'assets/img/cv/'), $path_photo);

        return $is_picture ? 'assets/img/photo/' . $path_photo : 'assets/img/cv/' . $path_photo;
    }

    // Méthode pour supprimer une image
    private function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function uploadBac(Request $request){
        if(session()->has('user')){
            $student = Student::find(session()->get('user')['id']);
            $bacData = [
                'id' => (string) Str::uuid(),
                'date' => $request->input('date'),
                'category_id' => $request->input('category_id'),
                'level_id' => $request->input('level_id'),
            ];
            // Utilisation de updateOrCreate pour créer ou mettre à jour le bac
            $bac = Bac::updateOrCreate(['student_id' => $student->id], $bacData);

            if($bac){
                return redirect()->back()->with('success', 'Votre B.A.C a bien été mis à jour');
            }else{
                return redirect()->back()->with('error', 'Impossible de mettre a jour B.A.C.');
            }
        }
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function uploadFormation(Request $request){
        if(session()->has('user')){
            $student = Student::find(session()->get('user')['id']);
            // Supprimer tous les enregistrements Formation existants pour ce Student
            $student->formations()->delete();
            foreach ($request->input('date') as $index => $date) {
                $formation = Formation::create([
                    'id' => (string) Str::uuid(),
                    'content' => $request->input('content')[$index],
                    'date' => $date,
                    'sector_id' => $request->input('sector_id')[$index],
                ]);

                $student->formations()->attach($formation->id);
            }

            return redirect()->back()->with('success', "Formations mises à jour avec succès");
        }
    }
    /*public function uploadFormation(Request $request){
        if(session()->has('user')){
            $student = Student::find(session()->get('user')['id']);
            $formationsData = [];
            foreach ($request->input('date') as $index => $date) {
                $formation = Formation::create([
                    'id' => (string) Str::uuid(),
                    'content' => $request->input('content')[$index],
                    'date' => $date,
                    'sector_id' => $request->input('sector_id')[$index],
                ]);

                $formationsData[] = $formation->id;
            }
            $student->formations()->sync($formationsData);
            return redirect()->back()->with('success', "Formations mises à jour avec succès");
        }
    }*/

    /**
     * @param Illuminate\Http\Request $request
     */
    public function uploadCompetency(Request $request){
        if(session()->has('user')){
            $student = Student::find(session()->get('user')['id']);
            $student->competencies()->sync($request->input('competency_id'));
            return redirect()->back()->with('success', "Compétences mises à jour avec succès");
        }
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function uploadDaily(Request $request)
    {
        if (session()->has('user')) {
            $student = Student::find(session()->get('user')['id']);

            // Supprimer tous les enregistrements Daily existants pour ce Student
            $student->dailies()->delete();

            foreach ($request->input('day_id') as $index => $dayId) {
                $time = $request->input('time')[$index];

                $daily = Daily::create([
                    'id' => (string) Str::uuid(),
                    'day_id' => $dayId,
                    'time' => $time,
                ]);

                $student->dailies()->attach($daily->id);
            }

            return redirect()->back()->with('success', "Disponibilité journalière mise à jour avec succès");
        }
    }
    /*public function uploadDaily(Request $request){
        if(session()->has('user')){
            $student = Student::find(session()->get('user')['id']);
            $dailiesData = [];
            foreach ($request->input('time') as $index => $time) {
                $dayly = Daily::create([
                    'id' => (string) Str::uuid(),
                    'day_id' => $request->input('day_id')[$index],
                    'time' => $time,
                ]);

                $dailiesData[] = $dayly->id;
            }
            $student->dailies()->sync($dailiesData);
            return redirect()->back()->with('success', "Disponibilité journalière mises à jour avec succès");
        }
    }*/

    /**
     * @param Illuminate\Http\Request $request
     */
    public function uploadPeriodical(Request $request)
    {
        //dd($request->all());
        if (session()->has('user')) {
            $student = Student::find(session()->get('user')['id']);
            // Supprimer tous les enregistrements Daily existants pour ce Student
            $student->periodicals()->delete();
            $periodicalsData = [];

            foreach ($request->input('periode') as $index => $period){
                $startDate = explode(" au ", $period)[0];
                $endDate = explode(" au ", $period)[1];
                $periodical = Periodical::updateOrCreate(
                    ['start' => $startDate, 'end' => $endDate],
                    ['id' => (string) Str::uuid()]
                );

                //$periodicalsData[] = $periodical->id;
                $student->periodicals()->attach($periodical->id);
            }
            //$student->periodicals()->syncWithoutDetaching($periodicalsData);
            return redirect()->back()->with('success', "Disponibilité annuelle mise à jour avec succès");
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadCV(Request $request){
        if ($request->cv->isValid()) {
            $student = Student::find(session()->get('user')['id']);

            if (!$student) {
                return response()->json(['message' => 'Impossible de trouver l\'etudiant correspondant', 'code' => 1]);
            }

            // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
            $cv = $student->cv;

            if ($cv) {
                // Si l'image existe déjà, mettez à jour le champ "url"
                $this->deleteImage($cv); // Supprime l'ancienne image si nécessaire
            }
            $cv = $this->moveImage($request->cv, false); // Met à jour le champ "url"
            $student->cv = $cv;
            if($student->save()){
                return response()->json(['message' => 'Votre photo a bien été mis à jour', 'code' => 0]);
            }

            return response()->json(['message' => 'Impossible de mettre à jour votre CV.', 'code' => 1]);

        }
        return response()->json(['message' => 'Aucune document trouvée.', 'code' => 1]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function coverLetter(Request $request){

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

        $student = Student::find(session()->get('user')['id']);

        $aboutData = [
            'id' => (string) Str::uuid(),
            'website' => $request->input('website'),
            'link_fb' => $request->input('link_fb'),
            'link_in' => $request->input('link_in'),
            'content' => $request->input('content'),
        ];

        $about = $student->about()->updateOrCreate(['aboutable_id' => $student->id], $aboutData);
        if ($about) {
            // Succès : L'enregistrement a été mis à jour ou créé avec succès
            // Vous pouvez maintenant utiliser $about si nécessaire
            return back()->with('success', "Mise à jour de la lettre de motivation réussie");
        } else {
            // Échec : Il y a eu un problème lors de la mise à jour ou de la création
            return back()->withErrors(['erreur'])->withInput();
        }
    }
}
