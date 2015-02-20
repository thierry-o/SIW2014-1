<?php

class NouveauDossierController extends BaseController {

    public function getNouveauDossier() // première entrée

    {
		return View::make('nouveauDossier');
    }

    public function postNouveauDossier()

    {
	 if (Input::has('validnouv'))//entrée suite à premiere validation dans la vue
	 {
		$validation = Validator::make(
			array('nom' => Input::get('nom')),
			array('nom' => 'required|min:3|max:20|alpha_num')
			);
        if ($validation->fails()) //echec de validation=> on affiche les messages
		{
			return Redirect::to('nouveauDossier')->withErrors($validation)->withInput();
        } 
		else //validation des donnees ok
		{
			$data['nom'] = Input:: get('nom');
			$data['validnouv'] = 'Valider';
			return View::make('nouveauDossier', $data);
        }
	 }
	 else//première entrée dans la page
	 {
		 return View::make('nouveauDossier');
	 }

    }

}