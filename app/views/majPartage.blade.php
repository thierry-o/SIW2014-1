@extends('modele_base')


@section('contenu')
		<fieldset>
<?php
//initialisatin des variables
//id du fichier
$numIdFich=intval(Input::get('idFichier'));
//nombre d'utilisateurs
$nombreUtils = DB::table('utilisateur')->count();
//liste des id et des noms des utilisateurs
$listeUtils=DB::table('utilisateur')->select('id', 'util_pseudo')->get();

//pour chaque utilisateur
foreach ($listeUtils as $listeUtil)
{
	$numIdUtil=$listeUtil->id;///id de l'utilisateur
	if ($numIdUtil != Auth::id())//on ne vérifie pas pour l'utilisateur qui partage
	{
		//vérification si un partage existe en faveur de l'utilisateur
		$partage=DB::table('partage')->select('part_util_id', 'part_type', 'part_chemin')->where('part_fich_id', $numIdFich)->where('part_util_id', $numIdUtil)->first();
		//attribution du type de partage existant dans la base
		(!isset($partage)) ? $typeBase=0:$typeBase=$partage->part_type;
		//comparaison du type de partage dans la base et dans Input
		Input::has('type'.$numIdUtil) ? $typeActuel=Input::get('type'.$numIdUtil) : $typeActuel=0;
		if ($typeBase != $typeActuel)//si les droits ont été modifiés, on les actualise
		{
			if($typeActuel=="0")//le partage a été supprimé
			{
				//suppression du partage dans la table
				DB::table('partage')->where('part_fich_id', $numIdFich)->where('part_util_id', $numIdUtil)->delete();
				//suppression de la copie du fichier
				$chemin=$partage->part_chemin."/".Input::get('fichier');
				if (file_exists($chemin))
				{
					unlink($chemin);
				}
			}
			if($typeActuel!="0")//le partage a été modifié
			{
				//récupération du chemin du dossier partagé
				$pos = strpos(Input::get('dossier'), 'documents');
				$chemin=substr(Input::get('dossier'), 0, $pos+9)."/".$listeUtil->util_pseudo."/Partage";
				
				//suppression du partage dans la table
				DB::table('partage')->where('part_fich_id', $numIdFich)->where('part_util_id', $numIdUtil)->delete();
				//création du partage dans la table
				DB::table('partage')->insert(array('part_util_id' => $numIdUtil, 'part_fich_id' => $numIdFich, 'part_type' => intval($typeActuel), 'part_chemin' => $chemin));
				//création du fichier si nécessaire
				$fichier=Input::get('dossier')."/".Input::get('fichier');
				$copie=$chemin."/".Input::get('fichier');
				if (!file_exists($copie))
				{
					copy($fichier, $copie);
				}
			}
		}
	}

}
//confirmation et retour accueil
echo "<h3>Les partages ont ete mis a jour</h3>";
echo "<form action=\"appli\" method=\"get\">";
echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
echo '<input type="submit" value="OK"/>';
echo '</form>';
?>
		</fieldset>
@stop