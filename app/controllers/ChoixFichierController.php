<?php

class ChoixFichierController extends BaseController {

    public function getChoixFichier()

    {
		$donnees=Input::all();

		if (substr(Session::get('dossCourant'), -7)=="Partage")//choix d'un fichier dans le dossier "Partage"
		{
//var_dump(Session::all());
// echo"***";
// var_dump(Input::all());
// echo"***";
			//récupération de l'id du fichier
			$fichier=Input::get('dossier')."/".Input::get('fichier');
			$fic=fopen($fichier, 'r');
			$ligne=fgets($fic);
			fclose($fic);
			$id=intval($ligne);
			//vérification du type de partage
			$req=DB::table('partage')->where('part_fich_id', $id)->where('part_util_id', Auth::id())->first();
			$type=$req->part_type;
			//redirection vers la page correcte
			switch ($type)
			{
				case 1:
					return View::make('consultFichier');
//					echo("consulter");
					break;
				case 3:
					return View::make('lireFichier');
//					echo("modifier");
					break;
			}
//			return View::make('consultFichier');
//			echo "consult";
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
//			echo("partagerFichier");
			return View::make('partagerFichier');
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


