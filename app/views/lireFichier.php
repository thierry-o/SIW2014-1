
<?php
//fonction de conversion de csv en tableau
function lireCSV($fichierCsv){
	$fic = fopen($fichierCsv, 'r');
	while (!feof($fic) ) {
		$ligne[] = fgetcsv($fic, 1024);
	}
	fclose($fic);
	return $ligne;
}


//initialisatin du chemin vers le fichier
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
//affichage du formulaire
echo "<h3>Saisie des donnees</h3>";
echo '<form action="editeFichier" method="post">';
//envoi masqué des variables
echo "<input type=\"hidden\" value=\"".$fichierCsv."\" name=\"fichierCsv\" />";
echo "<input type=\"hidden\" value=\"".$idFichier."\" name=\"idFichier\" />";
//création du masque de saisie		
echo "<table border=\"1\"><tr>";

//en-tete
for ($i=0;$i<$nbrChamp;$i++)
{
	echo "<td>".$csv[1][$i]."</td>";
	echo "<input type=\"hidden\" value=\"".$csv[1][$i]."\" name=\"champ0".$i."\" /></td>";
}
echo "</tr>";
//types
for ($i=0;$i<$nbrChamp;$i++)
{
	$type[]=$csv[2][$i];//types
	echo "<input type=\"hidden\" value=\"".$csv[2][$i]."\" name=\"champ1".$i."\" />";
}
echo "</tr>";

//corps
for ($j=3;$j<$nbrLigne;$j++)
{
	for ($i=0;$i<$nbrChamp;$i++)
	{
	 echo "<td><input type=\"".$type[$i]."\" value=\"".$csv[$j][$i]."\" name=\"champ".($j-1).$i."\" /></td>";	 
	}
	echo "</tr>";
}

echo "</table>";
//variables envoyees
echo "<input type=\"hidden\" value=\"".$nbrLigne."\" name=\"nbrLigne\" />";
echo "<input type=\"hidden\" value=\"".$nbrChamp."\" name=\"nbrChamp\" />";
echo '<input type="submit" name="finsaisie" value="Enregistrer" />';
echo '</form>';
//formulaire-bouton pour l'export PDF
echo '<form action="creePdf" method="post">';
echo "<input type=\"hidden\" name=\"fichier\" value=\"".Input::get('fichier')."\" />";
echo "<input type=\"hidden\" name=\"dossier\" value=\"".Input::get('dossier')."\" />";
echo '<input type="submit" name="pdf" value="Export en PDF" />';
echo '</form>';
?>
