<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Sector;
use App\Models\Student;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::find(session()->get('user')['id']);
        return view('my-requests', [
            'requests' => $student->requests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('user')){
            $student = Student::find(session()->get('user')['id']);
            return view('new-request', [
                'student' => $student,
                'types' => Type::all(),
                'cities' => City::all(),
                'sectors' => Sector::all(),
                'requests' => $student->requests,
                'request' => new \App\Models\Request()
            ]);
        }else{
            return redirect()->route('login.page')->with('warning', "Pour profiter pleinement de notre plateforme et accéder à toutes ses fonctionnalités, veuillez vous connecter à votre compte.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if(session()->has('user')){
            $validators = Validator::make($request->all(), [
                'student_id' => 'required|exists:students,id',
                'title' => 'required|min:3',
                'city_id' => 'required|array|exists:cities,id',
                'type_id' => 'required|array|exists:types,id',
                'sector_id' => 'required|numeric|exists:sectors,id',
                'content' => 'required|string|min:3',
            ]);
            $errors = $validators->errors();
            if($validators->fails()){
                return back()->withErrors($errors)->withInput();
            }

            $myRequet = \App\Models\Request::create([
                'id' => (string) Str::uuid(),
                'student_id' => $request->input('student_id'),
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'sector_id' => $request->input('sector_id'),
            ]);
            if($myRequet){
                $myRequet->cities()->sync($request->input('city_id'));
                $myRequet->types()->sync($request->input('type_id'));
                return redirect()->route('request.show', $myRequet)->with('success', "Votre demande a bien été soumi");
            }else{
                return back()->with('erreur', "Impossible de soumettre votre demande")->withInput();
            }
        }else{
            return redirect()->route('login.page')->with('erreur', "Vous devez vous connecter pour bénéficier pleinement de notre plateforme");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Request $request)
    {
        return view('request', [
            'request' => $request
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        if(session()->has('user')){
            $student = Student::find(session()->get('user')['id']);
            $request = \App\Models\Request::find($id);
            return view('new-request', [
                'student' => $student,
                'types' => Type::all(),
                'cities' => City::all(),
                'sectors' => Sector::all(),
                'request' => $request
            ]);
        }else{
            return redirect()->route('login.page')->with('warning', "Pour profiter pleinement de notre plateforme et accéder à toutes ses fonctionnalités, veuillez vous connecter à votre compte.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $myRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $myRequest)
    {
        $myRequest = \App\Models\Request::find($myRequest);
        $updatedRows = \App\Models\Request::find($myRequest->id)->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'sector_id' => $request->input('sector_id'),
        ]);
        if($updatedRows){
            $myRequest->cities()->sync($request->input('city_id'));
            $myRequest->types()->sync($request->input('type_id'));
            return redirect()->route('request.show', $myRequest)->with('success', "Votre demande a bien été mise à jour");
        }else{
            return back()->with('erreur', "Impossible de mettre à jour votre demande")->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $request = \App\Models\Request::find($id);
        if($request->delete()){
            return redirect()->route('request.index')->with('success', "Votre demande a bien été supprimer");
        }else{
            return back()->with('erreur', "Impossible de supprimer votre demande")->withInput();
        }
    }
}
