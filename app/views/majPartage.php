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
//suppression de tous les partages du fichier
$numIdFich=intval(Input::get('idFichier'));
DB::table('partage')->where('part_fich_id', $numIdFich)->delete();
//nombre d'utilisateurs
$nombreUtils = DB::table('utilisateur')->count();
//liste des id et des noms des utilisateurs
$liste=DB::table('utilisateur')->select('id', 'util_pseudo')->get();
echo ($nombreUtils);
//vérification pour chaque utilisateur s'il y a un partage
for ($i=1; $i<=$nombreUtils; $i++)
{
	if (Input::has('type'.$i))//si l'utilisateur est listé
	{
		$utilisateur=DB::table('utilisateur')->select('util_pseudo')->where('id', $i)->first();
		//récupération du dossier partagé
		$pos = strpos(Input::get('dossier'), 'documents');
		$chemin=substr(Input::get('dossier'), 0, $pos+9)."/".$utilisateur->util_pseudo."/Partage/".Input::get('fichier');
//		echo ($chemin);
//		echo(Input::get('dossier')."/".Input::get('fichier'));
		if  (Input::get('type'.$i)!="0")//lecture ou lecture/ecriture
		{
			echo ('$i '.$i." ".Input::get('type'.$i));
			//insertion du partage dans la table
			DB::table('partage')->insert(
				array('part_util_id' => $i, 'part_fich_id' => $numIdFich, 'part_type' => Input::get('type'.$i), 'part_chemin' => Input::get('dossier'))
				);
			//copie du fichier
			copy(Input::get('dossier')."/".Input::get('fichier'), $chemin);
		}
		else//pas partagé
		{
		}
	}
	//echo($donnee->name);
}
?>
		</fieldset>
	</body>
</html>