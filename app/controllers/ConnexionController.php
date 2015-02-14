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
				if (Auth::attempt(array('util_pseudo' => $nom, 'password' => $pass)))
				{
//					Session::put('id', Auth::user()->util_id);
//					Session::put('nom', $nom);
					return Redirect::to('appli');
				}
				else
				{
					echo '<h3>Mauvais identifiant ou mot de passe !</h3>';
					

				}				

    }

}