@extends('modele_base')


@section('contenu')
<html>
<head>
<link rel="stylesheet" href="css/style.css" />
</head>
<form method="post" action="connexion">

		<h3>Veuillez vous identifiez :</h3>
<fieldset>
<legend><h4> Connexion </h4> </legend>
<legend>Nom d'Utilisateur : </legend> <input type="text" name="nom"/>
<legend>Mot de passe : </legend><input type="password" name="pass"/></br>
</br>
<div id="connexion">
<input type="submit" name="valid" value="Connexion"/>
</div>
</fieldset>
<h3><?php if (isset($message)) {echo $message;} ?></h3>
</form>
@stop
</html>