<?php

class ChoixFichierController extends BaseController {

    public function getChoixFichier()

    {
		$donnees=Input::all();

		if (substr(Session::get('dossCourant'), -7)=="Partage")//choix d'un fichier dans le dossier "Partage"
		{
			echo "consult";
			//return Redirect::to('consultFichier', $donnees);
		}
		else//hors Partage
		{
			//echo ("get");
			
			return View::make('choixFichier', $donnees);
		}

    }

    public function postChoixFichier()

    {
			echo("post");

    }

}


