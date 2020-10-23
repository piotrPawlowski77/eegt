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

Route::get('/', 'FrontendController@index')->name('home');

Route::post('/save', 'FrontendController@save')->name('save');
Route::get('/findResearchDescription', 'FrontendController@findResearchDescription');
Route::get('/findResearchDate', 'FrontendController@findResearchDate');
Route::get('/findResearchHours', 'FrontendController@findResearchHours');

Route::get('/findVisit', 'FrontendController@findVisit')->name('findVisit');
Route::post('/findVisitResult', 'FrontendController@findVisitResult')->name('findVisitResult');

//raczej tak nie
//jesli get to bylo to przekierowanie do wyszukiwarki z numerem badania (research_code)
//jesli post to klikniecie przycisku search
//Route::match(['GET', 'POST'],'/findVisit'.'/{research_code?}', 'FrontendController@findVisit')->name('findVisit');
//end raczej tak nie

//routy do dynamic form
//Route::get('/form', 'DynamicFormController@formfunct');
//Route::get('/findResearchDescription', 'DynamicFormController@findResearchDescription');
//Route::get('/findResearchDate', 'DynamicFormController@findResearchDate');
//Route::get('/findResearchHours', 'DynamicFormController@findResearchHours');
//end routy do dynamic form

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){

    Route::get('/', 'BackendController@index')->name('adminHome');
    Route::get('/researchList', 'BackendController@researchList')->name('researchList');

    Route::get('/editResearch/{id}', 'BackendController@editResearch')->name('editResearch');
    Route::put('/updateResearch/{id}', 'BackendController@updateResearch')->name('updateResearch');
    Route::get('/deleteResearch/{id}', 'BackendController@deleteResearch')->name('deleteResearch');


});

//routy odp za logowanie, rejestracje, odzysk hasla
Auth::routes();
//przykladowy route gen auto aby wyswietlic panel logowania
//Route::get('/home', 'HomeController@index')->name('home');
