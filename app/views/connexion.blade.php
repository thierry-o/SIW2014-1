@extends('modele_base')


@section('contenu')
<form method="post" action="connexion">

		<h3>Veuillez vous identifier :</h3>
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