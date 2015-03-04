@extends('modele_base')
@section('contenu')

<?php
//fonctin de lecture du fichier
function lireCSV($fichierCsv){
	$fic = fopen($fichierCsv, 'r');
	while (!feof($fic) ) {
		$ligne[] = fgetcsv($fic, 1024);
	}
	fclose($fic);
	return $ligne;
}


// creation du chemin vers le fichier csv
if (isset($partage))//verification si ouverture d'un fichier partage
{
	$fichierCsv =  $partage."/".Input::get('fichier');
}
else
{
	$fichierCsv =  Input::get('dossier')."/".Input::get('fichier');
}
//lecture du fichier
$csv = lireCSV($fichierCsv);
//initialisation des variables
$nbrLigne= count($csv);
$nbrChamp=count($csv[1]);
$idFichier=$csv[0][0];

echo "<h3>Consultation des donnees du fichier : ".Input::get('fichier')."</h3>";
echo '<form action="appli" method="get">';
echo "<input type=\"hidden\" name=\"dir\" value=\"".Session::get('dossCourant')."\" />";

//création du tableau		
echo "<table border=\"1\"><tr>";

//en-tete
for ($i=0;$i<$nbrChamp;$i++)
{
	echo "<td>".$csv[1][$i]."</td>";
}
echo "</tr>";

//corps
for ($j=3;$j<$nbrLigne;$j++)//creation des lignes
{
	for ($i=0;$i<$nbrChamp;$i++)//insertion des donnees
	 {
	 echo "<td>".$csv[$j][$i]."</td>";
	}
	echo "</tr>";
}

echo "</table>";
echo "<br />";
echo '<input type="submit" name="finConsult" value="Fermer" />';
echo '</form>';
//bouton d'export PDF
echo '<form action="creePdf" method="post">';
//passage des variables
echo "<input type=\"hidden\" name=\"fichier\" value=\"".Input::get('fichier')."\" />";
echo "<input type=\"hidden\" name=\"dossier\" value=\"".Input::get('dossier')."\" />";
echo "<br />";
echo '<input type="submit" name="pdf" value="Export en PDF" />';
echo '</form>';
?>
@stop