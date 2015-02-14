<?php

class EditeFichierController extends BaseController {

    public function getEditeFichier()

    {
		//echo ("get");
        return View::make('EditeFichier');

    }

    public function postEditeFichier()

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
// var_dump(Session::all());
// echo"***";
// var_dump(Input::all());
//echo"***";
// var_dump(Input::old());
//			echo("post");
			$donnees=Input::all();
           return View::make('EditeFichier', $donnees);//->withInput();

//        }
//	 }
//	 else
//	 {
//	 return View::make('nouveauFichier');
//	 }

    }

}