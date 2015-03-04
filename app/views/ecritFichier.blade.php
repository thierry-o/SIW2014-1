@extends('modele_base')
@section('contenu')

<?php
//initialisation des variables
$fichierCsv=Input::get('fichierCsv');
$nbrLigne=Input::get('nbrLigne');
$nbrChamp=Input::get('nbrChamp');
$donnees="";//donnees a inscrire
//cr?ion de la ligne du fichier dans la base de donn?
DB::table('fichier')->insert(array('fich_nom' => Input::get('nom'), 'fich_chemin' => Session::get('dossCourant'), 'fich_proprio' => (Auth::user()->id)));
//recuperation de l'id du fichier cree
$id = DB::table('fichier')->select('fich_id', 'fich_nom')->where('fich_nom', Input::get('nom'))->where('fich_chemin', Session::get('dossCourant'))->first();
//ajout le d'id en t? de fichier
$donnees=$id->fich_id."\n";
//ajout des donnees
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
$fic = fopen($fichierCsv,"w+");
//ecriture
fputs($fic, $donnees);
//fermeture
fclose($fic);
//formulaire de confirmation
echo "<h3>Le ficher a ete cree</h3>";
echo "<form action=\"appli\" method=\"get\">";
echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
echo '<input type="submit" value="OK"/>';
echo '</form>';
?>
@stop