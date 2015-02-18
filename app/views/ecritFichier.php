
<?php
// var_dump(Session::all());
// echo"***";
// var_dump(Input::all());
//echo"***";
// var_dump(Input::old());
// echo "ok";
$fichierCsv=Input::get('fichierCsv');
$nbrLigne=Input::get('nbrLigne');
$nbrChamp=Input::get('nbrChamp');
$donnees="";
//création de la ligne du fichier dans la base de données
DB::table('fichier')->insert(
    array('fich_nom' => Input::get('nom'), 'fich_chemin' => Session::get('dossCourant'), 'fich_proprio' => (Auth::user()->id))
);
$id = DB::table('fichier')->select('fich_id', 'fich_nom')->where('fich_nom', Input::get('nom'))->where('fich_chemin', Session::get('dossCourant'))->first();
var_dump($id);

$donnees=$id->fich_id."\n";
for ($j=0;$j<$nbrLigne;$j++)
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
//echo $fichierCsv;
$fic = fopen($fichierCsv,"w+");
fputs($fic, $donnees);
fclose($fic);
//echo $donnees;
echo "<h3>Le ficher a ete cree</h3>";
echo "<form action=\"appli\" method=\"get\">";
echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
echo '<input type="submit" value="OK"/>';
echo '</form>';
