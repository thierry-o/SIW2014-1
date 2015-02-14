<?php

class ArticleController extends BaseController {

    public function show($n)

    {

        return View::make('article')->with('numero', $n);

    }

}