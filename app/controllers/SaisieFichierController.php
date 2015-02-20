<?php

class SaisieFichierController extends BaseController {

    public function getSaisieFichier()

    {
        return View::make('saisieFichier');

    }

    public function postSaisieFichier()

    {
		$donnees=Input::all();
		return View::make('saisieFichier', $donnees);
    }

}