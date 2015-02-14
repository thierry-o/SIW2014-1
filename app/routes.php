<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('hashpass', function()
{return View::make('hashpass');
});
Route::get('form',function(){
 //return app/views/form.blade.php
 return View::make('form');
});
Route::post('get',function(){
 //return app/views/form.blade.php
 var_dump(Input::all());
});

Route::get('connexion', 'ConnexionController@getConnexion')->before('guest');
Route::post('connexion', 'ConnexionController@postConnexion');
Route::get('appli',  function()
	{return View::make('appli');})->before('auth');
Route::get('logout', 'LogoutController@getLogout')->before('auth');
Route::get('nouveauFichier', 'NouveauFichierController@getNouveauFichier');//->before('guest');
Route::post('nouveauFichier', 'NouveauFichierController@postNouveauFichier');
Route::post('ecritFichier', 'EcritFichierController@postEcritFichier');
Route::post('editeFichier', 'EditeFichierController@postEditeFichier');
Route::any('lireFichier', function() {return View::make('lireFichier');});
Route::any('suppFichier', function() {return View::make('suppFichier');});

Route::get('nouveauDossier', 'NouveauDossierController@getNouveauDossier');//->before('guest');
Route::post('nouveauDossier', 'NouveauDossierController@postNouveauDossier');
Route::get('explorateur', function() {return View::make('explorateur');});
Route::get('saisieFichier', 'SaisieFichierController@getSaisieFichier');
Route::post('saisieFichier', 'SaisieFichierController@postSaisieFichier');
App::missing(function()
{  return 'Page inexistante !'; });
