<!DOCTYPE html>

<html lang="fr">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mon joli site</title>

    {{ HTML::style('https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}

    {{ HTML::style('https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css') }}

    <!--[if lt IE 9]>

      {{ HTML::style('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}

      {{ HTML::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}

    <![endif]-->

    <style> textarea { resize: none; } </style>

  </head>

  <body>

    @yield('contenu')

  </body>

</html>