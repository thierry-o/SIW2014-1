
<?php
 var_dump(Session::all());
 echo"***";
 var_dump(Input::all());
echo"***";
 var_dump(Input::old());

function lireCSV($fichierCsv){
	$fic = fopen($fichierCsv, 'r');
	while (!feof($fic) ) {
		$ligne[] = fgetcsv($fic, 1024);
	}
	fclose($fic);
	return $ligne;
}


// Set path to CSV file
$fichierCsv = Input::get('dossier')."/".Input::get('fichier');

$csv = lireCSV($fichierCsv);
var_dump($csv);
$nbrLigne= count($csv);
$nbrChamp=count($csv[1]);

$idFichier=$csv[0][0];
 echo "<h3>Consultation des donnees du fichier : ".Input::get('fichier')."</h3>";
echo '<form action="appli" method="get">';
echo "<input type=\"hidden\" name=\"dir\" value=\"".Session::get('dossCourant')."\" />";

//création du masque de saisie		
echo "<table border=\"1\"><tr>";

//en-tete
for ($i=0;$i<$nbrChamp;$i++)
{
	echo "<td>".$csv[1][$i]."</td>";
	
}
echo "</tr>";

//corps
for ($j=3;$j<$nbrLigne;$j++)
{
	for ($i=0;$i<$nbrChamp;$i++)
	 {
	 echo "<td>".$csv[$j][$i]."</td>";
	 
	}
	echo "</tr>";
}

echo "</table>";
echo '<input type="submit" name="finConsult" value="Fermer" />';
echo '</form>';
