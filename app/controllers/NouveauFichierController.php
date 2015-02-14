<?php

class NouveauFichierController extends BaseController {

    public function getNouveauFichier() // première entrée

    {
		return View::make('nouveauFichier');
//		echo ("redirection");
//        return Redirect::to('connexion');

    }

    public function postNouveauFichier()

    {
	 if (Input::has('validnouv'))//entrée suite à première validation
	 {
//		echo("validation");
		$validation = Validator::make(
			array('nom' => Input::get('nom')),
			array('nom' => 'required|min:3|max:20|alpha_num'),
			array('champs' => Input::get('champs')),
			array('champs' => 'required|min:1|max:10')
			);
        if ($validation->fails()) //erreur de saisie
		{
//          echo ("rate");
//		 echo $validation -> messages();
		  return Redirect::to('nouveauFichier')->withErrors($validation)->withInput();
        } 
		else //pas d'erreur, on peut continier
		{
//			echo("reussi, création du fichier");
//			return var_dump(Input::all());
//          return View::make('nouveauFichier');//->withInput();
//			return Redirect::to('nouveauFichier')->withInput();
			$data['nom'] = Input:: get('nom');
			$data['validnouv'] = 'Valider';
			return View::make('nouveauFichier', $data);

        }
	 }
	 elseif (Input::has('validerChamps'))//entree  suite à validaton des champs
	 {
		//echo "valide";
		return Redirect::to('saisieFichier')->withInput();
	 }
	 else//première entrée dans la page
	 {
//		 echo("pas devalidation");
//		 echo(Input::get('nom'));
//		 return var_dump(Input::all());
//		 return var_dump(Session::all());
		 return View::make('nouveauFichier');

		//return Redirect::to('nouveauFichier')->withInput();
	 }

    }

}