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
//var_dump(Session::all());
// echo"***";
// var_dump(Input::all());
//echo"***";
// var_dump(Input::old());
//			echo("post");
		//$donnees=Input::all();
		//$donnees['fic'] = Input::get('dossier')."/".Input::get('fichier');
	   switch (Input::get('choix'))
	   {
		case "consult":
			return View::make('consultFichier');
//			echo("consulter");
			break;
		case "modif":
			return View::make('lireFichier');
//			echo("modifier");
			break;
		case "partag":
			echo("partager");
			break;
		case "renomm":
			echo("renommer");
			break;
		case "suppr":
			//$donnees['fichier'] = Input::get('dossier')."/".Input::get('fichier');
			return View::make('suppFichier');//, $donnees);
			//var_dump($donnees);
			//echo("supprimer");
		}
		
    }

}


