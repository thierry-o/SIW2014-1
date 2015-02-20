@extends('modele_base')


@section('contenu')

<form method="post" action="connexion">

		<h3>Veuillez vous identifiez :</h3>
<fieldset>
<legend><h3> Connexion </h3> </legend>
<legend>Nom d'Utilisateur : </legend> <input type="text" name="nom"/>
<legend>Mot de passe : </legend><input type="password" name="pass"/></br>
</br>
<input type="submit" name="valid" value="Connexion"/>
</fieldset>
<h3><?php if (isset($message)) {echo $message;} ?></h3>
</form>
@stop