
<?php
 var_dump(Session::all());
 echo"***";
 var_dump(Input::all());
echo"***";
 var_dump(Input::old());
 echo "ok";
$fichierCsv=Input::get('fichierCsv');
$nbrLigne=Input::get('nbrLigne');
$nbrChamp=Input::get('nbrChamp');
$donnees="";

$donnees=Input::get('idFichier')."\n";
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
fputs($fic, $donnees);
fclose($fic);
//echo $donnees;
echo "<h3>Le ficher a ete modifie</h3>";
echo "<form action=\"appli\" method=\"get\">";
echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
echo '<input type="submit" value="OK"/>';
echo '</form>';
