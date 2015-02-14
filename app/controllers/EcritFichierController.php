<?php

class EcritFichierController extends BaseController {

    public function getEcritFichier()

    {
		//echo ("get");
        return View::make('EcritFichier');

    }

    public function postEcritFichier()

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
           return View::make('EcritFichier');//->withInput();

//        }
//	 }
//	 else
//	 {
//	 return View::make('nouveauFichier');
//	 }

    }

}