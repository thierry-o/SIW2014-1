<?php

class ConnexionController extends BaseController {

    public function getConnexion()

    {

        return View::make('connexion');

    }

    public function postConnexion()

    {

				$pass=Input::get('pass');
				$nom=Input::get('nom');
				//si l'authentification réussit, on entre dans l'appli
				if (Auth::attempt(array('util_pseudo' => $nom, 'password' => $pass)))
				{
					return Redirect::to('appli');
				}
				else//sinon on redemande de s'identifier
				{
					$message= 'Mauvais identifiant ou mot de passe !';
					return View::make('connexion')->with('message', $message);
				}				

    }

}