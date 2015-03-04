@extends('modele_base')
@section('contenu')
<?php
//enregistrement du fichier edite
//initialisation des variables
$fichierCsv=Input::get('fichierCsv');
$nbrLigne=Input::get('nbrLigne');
$nbrChamp=Input::get('nbrChamp');
$donnees="";
//id du fichier en premiere ligne
$donnees=Input::get('idFichier')."\n";
//donnees
for ($j=0;$j<$nbrLigne-1;$j++)
{
	for ($i=0;$i<$nbrChamp;$i++)
	{
		$champ="champ".$j.$i;
		$donnees=$donnees.Input::get($champ).",";
		//echo "ok";
	}
	$donnees=substr($donnees, 0, -1);
	$donnees=$donnees."\n";
}
$donnees=substr($donnees, 0, -1);
//ouverture du fichier
$fic = fopen($fichierCsv,"w+");
//enregistrement
fputs($fic, $donnees);
//feermeture
fclose($fic);
//formulaire de confirmation
echo "<h3>Le ficher a été modifie</h3>";
echo "<form action=\"appli\" method=\"get\">";
echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
echo '<input type="submit" value="OK"/>';
echo '</form>';
?>
@stop