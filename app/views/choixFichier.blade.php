@extends('modele_base')
@section('contenu')
		<fieldset>
<?php
			echo "<legend><h3>Fichier : \"".Input::get('fichier')."\"</h3></legend>";
?>
			<form method="post" action="choixFichier">
			<p>
<?php
			//donnees a passer a la vue suivante
			echo "<input type=\"hidden\" name=\"fichier\" value=\"".Input::get('fichier')."\" />";
			echo "<input type=\"hidden\" name=\"dossier\" value=\"".Input::get('dossier')."\" />";
?>
			<!--liste des choix-->
			<input type="radio" name="choix" value="consult" checked="checked" /> Consulter<br />
			<input type="radio" name="choix" value="modif"  /> Modifier<br />
			<input type="radio" name="choix" value="partag"  /> Partager<br />
			<input type="radio" name="choix" value="suppr"  /> Supprimer<br />
			</p>
			<input type="submit" name="valid" value="OK" />
			</form>
			<!--bouton d'annulation-->
			<form action="appli" method="get">
				<input type="hidden" name="dir" value="<?php echo Session::get('dossCourant'); ?>" />
				<input type="submit" value="Annuler" name="Annuler" />
			</form>
		</fieldset>
@stop
