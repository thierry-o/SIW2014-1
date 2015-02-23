<link rel="stylesheet" href="css/style.css" />
<?php
//initialisation du chemin
$fichier=Input::get('dossier')."/".Input::get('fichier');
if (substr(Session::get('dossCourant'), -7)=="Partage")//tentative de supprimer un fichier dans le dossier "Partage"
{
	echo '<div>Suppression du fichier impossible dans le dossier "Partage"</div>';
	echo "<form action=\"appli\" method=\"get\">";
	echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
	echo '<input type="submit" value="OK"/>';
	echo '</form>';
}
else //on n'est pas dans Partage, donc on peut supprimer
{

	//récupération de l'id du fichier
	$id = DB::table('fichier')->select('fich_id')->where('fich_nom', Input::get('fichier'))->where('fich_chemin', Input::get('dossier'))->first();
	$num=intval($id->fich_id);
	//listage des chemins vers les fichiers partagés
	$chemins = DB::table('partage')->select('part_chemin')->where('part_fich_id', $num)->get();
	//suppression de la base de données
	DB::table('partage')->where('part_fich_id', '=', $num)->delete();
	DB::table('fichier')->where('fich_id', '=', $num)->delete();
	//suppression des fichiers
	unlink($fichier);//fichier principal
	foreach ($chemins as $chemin)//fichiers partagés
	{
		if ($chemin->part_chemin===NULL)//chemin vide
		{
			echo ' Chemin non trouve';
		}
		else //partage trouve dans la table
		{
			//initialisation de chemin
			$fichier=$chemin->part_chemin."/".Input::get('fichier');
			//suppression
			unlink($fichier);
		}
	}
	echo "<h3>Le ficher a été supprimé</h3>";
	echo "<form action=\"appli\" method=\"get\">";
	echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
	echo '<input type="submit" value="OK"/>';
	echo '</form>';
}