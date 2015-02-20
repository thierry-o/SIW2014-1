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
	echo "<legend><h3>Partages du fichier : \"".Input::get('fichier')."\"</h3></legend>";
?>
		<form action="majPartage" method="post">
			<table border="1" bordercolor="gray">
				

<?php
 
//récupération de l'id du fichier
$idFich = DB::table('fichier')->select('fich_id')->where('fich_nom', Input::get('fichier'))->where('fich_chemin', Input::get('dossier'))->first();
$numIdFich=intval($idFich->fich_id);
//id de l'utilisateur
$numIdUtil=intval(Auth::id());
//lister les utilisateurs sauf l'utilisateur courant
$listeUtils = DB::table('utilisateur')->select('id', 'util_pseudo')->where('id', '<>', $numIdUtil)->get();
//pour chaque utilisateur on affiche l'état du partage
foreach ($listeUtils as $listeUtil)
{
		echo "<tr>";
		$numIdUtilListe=intval($listeUtil->id);//id de l'utilisateur
		//récupération du type de partage si le fichier est partagé avec l'utilisateur
		$listePartages = DB::table('partage')->select('part_type')->where('part_util_id', $numIdUtilListe)->where('part_fich_id', $numIdFich)->first();
		if (isset ($listePartages->part_type))
		{
			$typePartage=$listePartages->part_type;
		}
		else //partage pas trouve dans la table
		{
			$typePartage=0;
		}
		echo'<td>';
		//affichage du nom d'utilisateur
		echo $listeUtil->util_pseudo;
		echo '</td>';
		echo'<td>';
		//construction de la liste avec selection du choix actuel
		echo '<select name="type'.$listeUtil->id.'" id="type">';
		echo '<option value="0"';
		if ($typePartage==0)
		{
			echo " selected";
		}
		echo'>Non Partage</option>';
		echo '<option value="1"';
		if ($typePartage==1)
		{
			echo " selected";
		}
		echo'>Lecture</option>';
		echo '<option value="3"';
		if ($typePartage==3)
		{
			echo " selected";
		}
		echo'>Lecture/Ecriture</option>';
		echo '</select>';
		echo '</td>';
		echo "</tr>";
}
		

?>
			</table>
			<input type="hidden" name="fichier" value="<?php echo(Input::get('fichier')); ?>" />
			<input type="hidden" name="dossier" value="<?php echo(Input::get('dossier')); ?>" />
			<input type="hidden" name="idFichier" value="<?php echo($numIdFich); ?>" />
			<input type="submit" name="valid" value="OK"/>
		</form>
			<form action="appli" method="get">
				<input type="hidden" name="dir" value="<?php echo Session::get('dossCourant'); ?>" />
				<input type="submit" value="Annuler" name="Annuler" />
			</form>
		</fieldset>
	</body>
</html>