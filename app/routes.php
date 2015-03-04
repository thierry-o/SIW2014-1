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

Route::get('choixFichier', 'ChoixFichierController@getChoixFichier')->before('auth');
Route::post('choixFichier', 'ChoixFichierController@postChoixFichier')->before('auth');

Route::get('connexion', 'ConnexionController@getConnexion')->before('guest');
Route::post('connexion', 'ConnexionController@postConnexion')->before('guest');

Route::any('consultFichier', function() {return View::make('consultFichier');})->before('auth');

Route::post('ecritFichier', 'EcritFichierController@postEcritFichier')->before('auth');

Route::post('editeFichier', 'EditeFichierController@postEditeFichier')->before('auth');

Route::any('lireFichier', function() {return View::make('lireFichier');})->before('auth');

Route::post('majPartage', 'MajPartageController@postMajPartage')->before('auth');

Route::get('nouveauDossier', 'NouveauDossierController@getNouveauDossier')->before('auth');
Route::post('nouveauDossier', 'NouveauDossierController@postNouveauDossier')->before('auth');

Route::get('nouveauFichier', 'NouveauFichierController@getNouveauFichier')->before('auth');
Route::post('nouveauFichier', 'NouveauFichierController@postNouveauFichier')->before('auth');

Route::any('ouvrePartage', function() {return View::make('partagerFichier');})->before('auth');

Route::get('saisieFichier', 'SaisieFichierController@getSaisieFichier')->before('auth');
Route::post('saisieFichier', 'SaisieFichierController@postSaisieFichier')->before('auth');

Route::any('suppFichier', function() {return View::make('suppFichier');})->before('auth');

Route::any('creePdf', 'CreePdfController@postCreePdf')->before('auth');

Route::get('logout', 'LogoutController@getLogout')->before('auth');

App::missing(function() {  return 'Page introuvable !'; });
