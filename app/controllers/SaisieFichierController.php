<?php

class SaisieFichierController extends BaseController {

    public function getSaisieFichier()

    {
		//echo ("get");
        return View::make('saisieFichier');

    }

    public function postSaisieFichier()

    {
//	 if (!Input::has('nouvfich'))
//	 {
//		$validation = Validator::make(
//			array('name' => Input::get('nom')),
//			array('name' => 'required|min:3|max:20|alpha_num')
//			);
//        if ($validation->fails()) {
          //echo ("rate");
//		  return View::make('nouveauFichier')->withErrors($validation);//->withInput();
//        } else {
//			echo("post");
$donnees=Input::all();
return View::make('saisieFichier', $donnees);
//           return Redirect::to('saisieFichier')->withInput();
//var_dump(Session::all());
// echo"***";
//var_dump(Input::all());
//echo"***";
// var_dump(Input::old());


//        }
//	 }
//	 else
//	 {
//	 return View::make('nouveauFichier');
//	 }

    }

}