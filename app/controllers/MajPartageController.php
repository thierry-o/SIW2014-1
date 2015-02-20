<?php

class MajPartageController extends BaseController {

    public function getMajPartage()

    {
			echo ("get");
			

    }

    public function postMajPartage()

    {
		return View::make('majPartage');
    }

}


