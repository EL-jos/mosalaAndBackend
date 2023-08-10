<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Competency;
use App\Models\Contract;
use App\Models\Country;
use App\Models\Day;
use App\Models\Gender;
use App\Models\Level;
use App\Models\Sector;
use App\Models\Student;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    public function home(){
        //dd(Student::where('id', '=', 'b0e2e32a-10b9-4407-9ce3-ab81ce0721bd')->first()->image->url);
        return view('home',[
            //'countries' => Country::with('states.cities')->get(),
            'types' => Type::all(),
            'cities' => City::all(),
            'students' => Student::all(),
            'requests' => \App\Models\Request::all()
        ]);
    }

    public function offers(){
        return view('offers', [
            'cities' => City::all(),
            'types' => Type::all(),
            'contracts' => Contract::all(),
            'levels' => Level::all(),
            'sectors' => Sector::all(),
            'availabilities' => Availability::all()
        ]);
    }

    public function requests(){
        return view('requests', [
            'cities' => City::all(),
            'types' => Type::all(),
            'contracts' => Contract::all(),
            'levels' => Level::all(),
            'sectors' => Sector::all(),
            'availabilities' => Availability::all()
        ]);
    }

    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function createCompany(){
        return view('create-account-company', [
            'genders' => Gender::all()
        ]);
    }

    public function createStudent(){
        return view('create-account-student', [
            'genders' => Gender::all(),
        ]);
    }

    /**
     * @param Company $company
     */

    public function accountCompany(Company $company){

        //dd($company);
        //dd(Company::where('id', '=', session()->get('user')['id'])->first(), Company::where('id', '=', session()->get('user')['id'])->first()->entity);
        if(!session()->has('user')){
            return redirect()->route('login.page')->with('warning', "Pour profiter pleinement de notre plateforme et accéder à toutes ses fonctionnalités, veuillez vous connecter à votre compte.");
        }
        return view('account-company', [
            'company' => $company,
            'genders' => Gender::all(),
            'countries' => Country::with('states.cities')->get(),
            'sectors' => Sector::all(),
        ]);
    }

    /**
     * @param Student $student
     */
    public function accountStudent(Student $student){
        return view('account-student', [
            'genders' => Gender::all(),
            'countries' => Country::with('states.cities')->get(),
            'categories' => Category::all(),
            'levels' => Level::all(),
            'sectors' => Sector::all(),
            'competencies' => Competency::all(),
            'days' => Day::all(),
            'student' => $student
        ]);
    }

    public function article(){
        return view('article');
    }

    public function coverLetter(Student $student){
        return view('cover-letter', [
            'student' => $student
        ]);
    }
    /**
     * @param Student $student
     */
    public function newRequest(Student $student){
        //'countries' => Country::with('states.cities')->get(),
        if(session()->has('user')){
            return view('new-request', [
                'student' => $student,
                'types' => Type::all(),
                'cities' => City::all(),
                'sectors' => Sector::all(),
                'requests' => $student->requests,
            ]);
        }else{
            return redirect()->route('login.page')->with('warning', "Pour profiter pleinement de notre plateforme et accéder à toutes ses fonctionnalités, veuillez vous connecter à votre compte.");
        }

    }
}
