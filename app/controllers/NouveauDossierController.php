<?php

class NouveauDossierController extends BaseController {

    public function getNouveauDossier() // première entrée

    {
		return View::make('nouveauDossier');
//		echo ("redirection");
//        return Redirect::to('connexion');

    }

    public function postNouveauDossier()

    {
	 if (Input::has('validnouv'))//entrée suite à validation
	 {
//		echo("validation");
		$validation = Validator::make(
			array('nom' => Input::get('nom')),
			array('nom' => 'required|min:3|max:20|alpha_num')
			);
        if ($validation->fails()) 
		{
//          echo ("rate");
//		 echo $validation -> messages();
		  return Redirect::to('nouveauDossier')->withErrors($validation)->withInput();
        } 
		else 
		{
//			echo("reussi, création du fichier");
//			return var_dump(Input::all());
//          return View::make('nouveauDossier');//->withInput();
//			return Redirect::to('nouveauDossier')->withInput();
			$data['nom'] = Input:: get('nom');
			$data['validnouv'] = 'Valider';
			return View::make('nouveauDossier', $data);

        }
	 }
	 else//première entrée dans la page
	 {
//		 echo("pas devalidation");
//		 echo(Input::get('nom'));
//		 return var_dump(Input::all());
//		 return var_dump(Session::all());
		 return View::make('nouveauDossier');

		//return Redirect::to('nouveauDossier')->withInput();
	 }

    }

}