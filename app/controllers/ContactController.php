<?php

class ContactController extends BaseController {

    public function __construct()

    {

        parent::__construct();

    }

    public function getForm()

    {

        return View::make('contact');

    }

    public function postForm()

    {

        $regles = array(

            'nom' => 'required|min:5|max:20|alpha',

            'email' => 'required|email',

            'texte' => 'required|max:250'

        );

        $validation = Validator::make(Input::all(), $regles);

        if ($validation->fails()) {

          return Redirect::to('contact/form')->withErrors($validation)->withInput();

        } else {

            Mail::send('emails.contact', Input::all(), function($m) {

                $m->to('thierry.oddou@laposte.net')->subject('Contact');

            });

            return View::make('confirm');

        }

    }

}