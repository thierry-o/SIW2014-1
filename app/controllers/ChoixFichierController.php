<?php

class ChoixFichierController extends BaseController {

    public function getChoixFichier()

    {
		$donnees=Input::all();

		if (substr(Session::get('dossCourant'), -7)=="Partage")//choix d'un fichier dans le dossier "Partage"
		{
			//initialiosation du chemin
			$fichier=Input::get('dossier')."/".Input::get('fichier');
			//ouverture du fichier et lecture de la premiere ligne (contenant l'id)
			$fic=fopen($fichier, 'r');
			$ligne=fgets($fic);
			fclose($fic);
			//récupération de l'id du fichier
			$id=intval($ligne);
			//vérification du type de partage
			$req=DB::table('partage')->where('part_fich_id', $id)->where('part_util_id', Auth::id())->first();
			$type=$req->part_type;
			//recuperation du chemin vers le fichier
			$req=DB::table('fichier')->where('fich_id', $id)->first();
			$dossier=$req->fich_chemin;
			//redirection vers la page correcte
			switch ($type)
			{
				case 1://si partage lecture =>consultation
					return View::make('consultFichier', array('partage' => $dossier));//ajout du chemin vers le fichier d'origine
					break;
				case 3://si partage lect-ecriture => modification
					return View::make('lireFichier', array('partage' => $dossier));//ajout du chemin vers le fichier d'origine
					break;
			}
		}
		else//hors Partage
		{
			return View::make('choixFichier', $donnees);
		}
    }

    public function postChoixFichier()
    {
	   switch (Input::get('choix'))
	   {
		case "consult":
			return View::make('consultFichier');
			break;
		case "modif":
			return View::make('lireFichier');
			break;
		case "partag":
			return View::make('partagerFichier');
			break;
		case "suppr":
			return View::make('suppFichier');
		}
		
    }

}


