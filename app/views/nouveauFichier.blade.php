@extends('modele_base')


@section('contenu')
<fieldset><br>
	<legend><h3>Nouveau Fichier</h3></legend>
<?php
if (substr(Session::get('dossCourant'), -7)=="Partage")//tentative de creer un fichier dans le dossier "Partage"
{
	echo '<div>Création du fichier impossible dans le dossier "Partage"</div>';
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
			<form action="nouveauFichier" method="post">
				<table>				
				<tr><td>Nom du Fichier : </td><td><input type="text" name="nom" id="nom" value="" required/></td></tr>
				<tr><td>Nombre de champs : </td><td><input type="number" name="champs" nim="1" max="10" value="1" required></td></tr>
				<tr><td>Nombre de lignes : </td><td><input type="number" name="lignes" nim="1" max="10" value="1" required></td></tr>
				</table>

	<?php
		if ($errors->has('nom'))//erreur sur le nom
		{
			echo $errors->first('nom');
			echo "<br />";
		}
	?>
				</p>
				<input type="submit" value="Valider" name="validnouv" />
			</form>
			<form action="appli" method="get">
				<input type="hidden" name="dir" value="<?php echo Session::get('dossCourant'); ?>" />
				<input type="submit" value="Annuler" name="Annuler" />
			</form>
	<?php
	}
	else//sinon (pas d'erreur)
	{
		$fich=Session::get('dossCourant')."/".Input::get('nom');
		$nombre=Input::get('champs');
		$ligne=Input::get('lignes')+2;
		
		if (!File::isFile($fich))//vérification de l'existence du Fichier
		{
			echo '<form action="saisieFichier" method="POST">';	//formulaire de saisie

			for ($i=1; $i<=$nombre;$i++)
			{
				echo "Champ $i :<br />
					Nom : <input type=\"text\" name=\"nomChamp$i\" required><br />
					Type : <select name=\"typeChamp$i\" id=\"typeChamp$i\">
						<option value=\"text\">Texte</option>
						<option value=\"number\">Nombre</option>
						<option value=\"email\">Mail</option>
					</select></br>";
			}
			echo "<input type=\"hidden\" value=\"".Input::get('nom')."\" name=\"nom\" />";
			echo "<input type=\"hidden\" value=\"".$nombre."\" name=\"champs\" />";
			echo "<input type=\"hidden\" value=\"".$ligne."\" name=\"lignes\" />";
			echo '<input type="submit" value="OK" name="validerChamps" />';
			echo "</form>";
		}
		else
		{
			echo "Fichier déjà existant";
			//formulaire pour retour accueil
	?>

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