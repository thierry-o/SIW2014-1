<html>
	<head>
	 
		<script type="text/javascript" src="js/fonctions.js"></script>
				<style>

body{
font-family:Arial;

margin-left:5%;
margin-top:15%;
}
input{

background-color:#AFEEEE;
padding:3px;
border:1px solid #00BFFF;
border-radius:5px;
}

fieldset{
width:400px;
margin:auto;
border:2px solid #00BFFF;
-moz-border-radius:8px;
    -webkit-border-radius:8px;	
    border-radius:8px;	
}
        </style>
	</head>
	<body>
		<fieldset>
<?php
 var_dump(Session::all());
 echo"***";
 var_dump(Input::all());
echo"***";
// var_dump(Input::old());
// echo "ok";

$numIdFich=intval(Input::get('idFichier'));

//nombre d'utilisateurs
$nombreUtils = DB::table('utilisateur')->count();
//liste des id et des noms des utilisateurs
$listeUtils=DB::table('utilisateur')->select('id', 'util_pseudo')->get();
//liste des partages du fichier
//$partages=DB::table('partage')->select('part_util_id', 'part_type')->where('part_fich_id', $numIdFich)->get();
echo ($nombreUtils);
//var_dump ($partages);
// echo"***";
var_dump($listeUtils);
 echo"***";
//pour chaque utilisateur
foreach ($listeUtils as $listeUtil)
{
	$numIdUtil=$listeUtil->id;
	if ($numIdUtil != Auth::id())//on ne vérifie pas pour l'utilisateur qui partage
	{
		//vérification si un partage existe en faveur de l'utilisateur
		$partage=DB::table('partage')->select('part_util_id', 'part_type', 'part_chemin')->where('part_fich_id', $numIdFich)->where('part_util_id', $numIdUtil)->first();
		//var_dump($partage);
		// echo"***";
		//attribution du type de partage existant dans la base
		(!isset($partage)) ? $typeBase=0:$typeBase=$partage->part_type;
		echo "type base ".$typeBase." ";
		
		//comparaison du type de partage dans la base et dans Input
		Input::has('type'.$numIdUtil) ? $typeActuel=Input::get('type'.$numIdUtil) : $typeActuel=0;
			echo "type actuel".$typeActuel." ";
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
	//				exec('ln -s $fichier $copie');
				}
				
				
				
			}
		}
	}

}

?>
		</fieldset>
	</body>
</html>