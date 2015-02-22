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

Route::get('appli',  function()	{return View::make('appli');})->before('auth');

Route::get('choixFichier', 'ChoixFichierController@getChoixFichier');//->before('guest');
Route::post('choixFichier', 'ChoixFichierController@postChoixFichier');//->before('guest');

Route::get('connexion', 'ConnexionController@getConnexion')->before('guest');
Route::post('connexion', 'ConnexionController@postConnexion');

Route::any('consultFichier', function() {return View::make('consultFichier');});

Route::post('ecritFichier', 'EcritFichierController@postEcritFichier');

Route::post('editeFichier', 'EditeFichierController@postEditeFichier');

Route::any('lireFichier', function() {return View::make('lireFichier');});

Route::post('majPartage', 'MajPartageController@postMajPartage');

Route::get('nouveauDossier', 'NouveauDossierController@getNouveauDossier');//->before('guest');
Route::post('nouveauDossier', 'NouveauDossierController@postNouveauDossier');

Route::get('nouveauFichier', 'NouveauFichierController@getNouveauFichier');//->before('guest');
Route::post('nouveauFichier', 'NouveauFichierController@postNouveauFichier');

Route::any('ouvrePartage', function() {return View::make('partagerFichier');});

Route::get('saisieFichier', 'SaisieFichierController@getSaisieFichier');
Route::post('saisieFichier', 'SaisieFichierController@postSaisieFichier');

Route::any('suppFichier', function() {return View::make('suppFichier');});

Route::any('creePdf', 'CreePdfController@postCreePdf');

Route::get('logout', 'LogoutController@getLogout')->before('auth');

App::missing(function() {  return 'Page introuvable !'; });
