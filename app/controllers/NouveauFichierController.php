<?php

class NouveauFichierController extends BaseController {

    public function getNouveauFichier() // première entrée

    {
		return View::make('nouveauFichier');
    }

    public function postNouveauFichier()

    {
		 if (Input::has('validnouv'))//entrée suite à première validation
		 {
			$validation = Validator::make(
				array('nom' => Input::get('nom')),
				array('nom' => 'required|min:3|max:20|alpha_num'),
				array('champs' => Input::get('champs')),
				array('champs' => 'required|min:1|max:10')
				);
			if ($validation->fails()) //erreur de saisie
			{
				//retour des erreurs
				return Redirect::to('nouveauFichier')->withErrors($validation)->withInput();
			} 
			else //pas d'erreur, on peut continier
			{
				$data['nom'] = Input:: get('nom');
				$data['validnouv'] = 'Valider';
				return View::make('nouveauFichier', $data);//vue de saisie des champs
			}
		 }
		 elseif (Input::has('validerChamps'))//entree  suite à validation des champs
		 {
			return Redirect::to('saisieFichier')->withInput();
		 }
		 else//première entrée dans la page
		 {
			 return View::make('nouveauFichier');
		 }

    }

}