@extends('modele_base')
@section('contenu')
<fieldset>
	<legend><h3>Nouveau Dossier</h3></legend>
<?php

if (substr(Session::get('dossCourant'), -7)=="Partage")//tentative de creer un dossier dans le dossier "Partage"
{
	echo '<div>Création du dossier impossible dans le dossier "Partage"</div>';
	echo "<form action=\"appli\" method=\"get\">";
	echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
	echo '<input type="submit" value="OK"/>';
	echo '</form>';
}
else //on n'est pas dans Partage, donc on peut créer
{
	if ((!Input::has('validnouv')) | ($errors->has('nom')))//s'il y a des erreurs ou si c'est la première entrée, on affiche le formulaire
	{
?>	
			<form action="nouveauDossier" method="post">
				<p>
				Nom du Dossier : <input type="text" name="nom" id="nomdoss" value="<?php echo Input::old('nom'); ?>"/><br />
<?php
if ($errors->has('nom'))//affichage des erreurs sur le nom
{
	echo $errors->first('nom');
	echo "<br />";
}
?>
				</p>
				<input type="submit" value="Valider" name="validnouv" />
			</form>
			<!--formulaire-bouton d'annulation-->
			<form action="appli" method="get">
				<input type="hidden" name="dir" value="<?php echo Session::get('dossCourant'); ?>" />
				<br>
				<input type="submit" value="Annuler" name="Annuler" />
			</form>
		
<?php
}
else//sinon (pas d'erreur)
{
	//initialisation variable dossier
	$doss=Session::get('dossCourant')."/".Input::get('nom');
	if (!File::isDirectory($doss))//vérification de l'existence du dossier
	{
		mkdir($doss);//creation de dossier
		echo "Création réussie";
		echo "<form action=\"appli\" method=\"get\">";//formulaire de confirmation
		echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
		echo '<input type="submit" value="OK"/>';
		echo '</form>';
	}
	else
	{
		echo "Dossier déjà existant";
?>
			<!--formulaire-bouton d'acquiescement de dossier deja existant-->
			<form action="appli" method="get">
				<input type="hidden" name="dir" value="<?php echo Session::get('dossCourant'); ?>" />
				<input type="submit" value="OK" name="valider" />
			</form>
	</fieldset>
	<?php
		}
	}
}
?>
@stop