<?php
//controleur d'enregistrement du fichier edite
class EditeFichierController extends BaseController {

    public function getEditeFichier()

    {
        return View::make('EditeFichier');

    }

    public function postEditeFichier()

    {
			$donnees=Input::all();
           return View::make('EditeFichier', $donnees);
    }

}