<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*Route::get('/villes', function (){
    // Configuration de cURL
    $curlOptions = [
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
    ];

// Configuration du client Guzzle HTTP avec les options cURL
    $client = new \GuzzleHttp\Client([
        'curl' => $curlOptions,
    ]);

// Envoi de la requête à l'API GeoNames
    $response = $client->get('https://laravel-world.com/api/states?filters%5Bcountry_code%5D=AO&fields=cities');

// Récupération du corps de la réponse
    $body = $response->getBody();

// Conversion de la réponse JSON en tableau associatif
    $data = json_decode($body, true);
    //dd($data);

// Traitement des données
    if (isset($data['data'])) {
        //dump($data['data']);
        foreach ($data['data'] as $dataState) {
            $state = new \App\Models\State();
            $state->name = $dataState['name'];
            $state->country_id = 6;
            if($state->save()){
                foreach ($dataState['cities'] as $dataCity) {
                    $city = new \App\Models\City();
                    $city->name = $dataCity['name'];
                    $city->state_id = \App\Models\State::where('name', '=', $dataState['name'])->first()->id;
                    $city->save();
                }
            }
        }
    }
});*/

Route::get('/', ['as' => 'home.page', 'uses' => 'App\\Http\\Controllers\\PageController@home']);
Route::get('/offers', ['as' => 'offers.page', 'uses' => 'App\\Http\\Controllers\\PageController@offers']);
Route::get('/requests', ['as' => 'requests.page', 'uses' => 'App\\Http\\Controllers\\PageController@requests']);
Route::get('/register', ['as' => 'register.page', 'uses' => 'App\\Http\\Controllers\\PageController@register']);
Route::get('/login', ['as' => 'login.page', 'uses' => 'App\\Http\\Controllers\\PageController@login']);
Route::post('/login', ['as' => 'login.form', 'uses' => 'App\\Http\\Controllers\\AuthController@login']);
Route::post('/logout', ['as' => 'logout.form', 'uses' => 'App\\Http\\Controllers\\AuthController@logout']);
Route::get('/createCompany', ['as' => 'createCompany.page', 'uses' => 'App\\Http\\Controllers\\PageController@createCompany']);
Route::get('/createStudent', ['as' => 'createStudent.page', 'uses' => 'App\\Http\\Controllers\\PageController@createStudent']);
Route::get('/accountCompany/{company}', ['as' => 'accountCompany.page', 'uses' => 'App\\Http\\Controllers\\PageController@accountCompany']);
Route::get('/accountStudent/{student}', ['as' => 'accountStudent.page', 'uses' => 'App\\Http\\Controllers\\PageController@accountStudent']);
Route::get('/article', ['as' => 'article.page', 'uses' => 'App\\Http\\Controllers\\PageController@article']);
Route::get('/cover-letter/{student}', ['as' => 'coverLetter.page', 'uses' => 'App\\Http\\Controllers\\PageController@coverLetter']);
Route::get('/newOffer', ['as' => 'newOffer.page', 'uses' => 'App\\Http\\Controllers\\PageController@newOffer']);
Route::get('/newRequest/{student}', ['as' => 'newRequest.page', 'uses' => 'App\\Http\\Controllers\\PageController@newRequest']);

Route::group(['prefix' => 'admin'], function(){
    Route::post('/upload-logo', ['as' => 'uploadLogo.page', 'uses' => 'App\\Http\\Controllers\\CompanyController@uploadLogo']);
    Route::post('/upload-photo', ['as' => 'uploadPhoto.page', 'uses' => 'App\\Http\\Controllers\\StudentController@uploadPhoto']);
    Route::post('/upload-bac', ['as' => 'uploadBac.form', 'uses' => 'App\\Http\\Controllers\\StudentController@uploadBac']);
    Route::post('/upload-formation', ['as' => 'uploadFormation.form', 'uses' => 'App\\Http\\Controllers\\StudentController@uploadFormation']);
    Route::post('/upload-competency', ['as' => 'uploadCompetency.form', 'uses' => 'App\\Http\\Controllers\\StudentController@uploadCompetency']);
    Route::post('/upload-daily', ['as' => 'uploadDaily.form', 'uses' => 'App\\Http\\Controllers\\StudentController@uploadDaily']);
    Route::post('/upload-periodical', ['as' => 'uploadPeriodical.form', 'uses' => 'App\\Http\\Controllers\\StudentController@uploadPeriodical']);
    Route::post('/upload-CV', ['as' => 'uploadCV.page', 'uses' => 'App\\Http\\Controllers\\StudentController@uploadCV']);
    Route::post('/add-about', ['as' => 'addAbout.company', 'uses' => 'App\\Http\\Controllers\\CompanyController@addAbout']);
    Route::post('/cover-letter', ['as' => 'coverLetter.student', 'uses' => 'App\\Http\\Controllers\\StudentController@coverLetter']);
    Route::resource('company', 'App\\Http\\Controllers\\CompanyController');
    Route::resource('student', 'App\\Http\\Controllers\\StudentController');
    Route::resource('request', 'App\\Http\\Controllers\\RequestController');
});
