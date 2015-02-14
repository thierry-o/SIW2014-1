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
<fieldset><br>
	<legend><h3><FONT COLOR="#0000FF">Nouveau Fichier</FONT></h3></legend>
<?php
var_dump(Session::all());
 echo"***";
 var_dump(Input::all());
echo"***";
 var_dump(Input::old());
if (substr(Session::get('dossCourant'), -7)=="Partage")//tentative de creer un fichier dans le dossier "Partage"
{
	echo '<div>Création du fichier impossible dans le dossier "Partage"</div>';
	echo "<form action=\"appli\" method=\"get\">";
	echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
	echo '<input type="submit" value="OK"/>';
	echo '</form>';
}
else //on n'est pas dans Partage, donc on peut créer
{


	if ((!Input::has('validnouv')) | ($errors->has('nom')))//s'il y a des erreurs ou si c'est la première entrée, on affiche le formulaire
	{
	?>	
			<form action="nouveauFichier" method="post">
				Nom du Fichier : <input type="text" name="nom" id="nom" value="" required/><br />
				Nombre de champs : <input type="number" name="champs" nim="1" max="10" value="1" required><br />
				Nombre de lignes : <input type="number" name="lignes" nim="1" max="10" value="1" required><br />

	<?php
		if ($errors->has('nom'))//erreur sur le nom
		{
			echo $errors->first('nom');
			echo "<br />";
		}
	?>
				</p>
				<input type="submit" value="Valider" name="validnouv" />
			</form>
			<form action="appli" method="get">
				<input type="hidden" name="dir" value="<?php echo Session::get('dossCourant'); ?>" />
				<input type="submit" value="Annuler" name="Annuler" />
			</form>
	<?php
	}
	else//sinon (pas d'erreur)
	{
		$fich=Session::get('dossCourant')."/".Input::get('nom');
		$nombre=Input::get('champs');
		$ligne=Input::get('lignes')+2;
		
		if (!File::isFile($fich))//vérification de l'existence du Fichier
		{
			//$res = fopen($fich,"x");

	//		echo "Création réussie";
	//		var_dump(Input::all());
	//		echo "<script >BoutonValider();</script>";
	//		$liste = array('nombre' => Input::get('champs'));

	//$liste = array_add($liste, 'key', 'value');
	//		echo '<form action="nouveauFichier" method="POST">';
			echo '<form action="saisieFichier" method="POST">';
			for ($i=1; $i<=$nombre;$i++)
			{
				echo "Champ $i :<br />
					Nom : <input type=\"text\" name=\"nomChamp$i\" required><br />
					Type : <select name=\"typeChamp$i\" id=\"typeChamp$i\">
						<option value=\"text\">Texte</option>
						<option value=\"number\">Nombre</option>
						<option value=\"email\">Mail</option>
					</select></br>";
			}
			echo "<input type=\"hidden\" value=\"".Input::get('nom')."\" name=\"nom\" />";
			echo "<input type=\"hidden\" value=\"".$nombre."\" name=\"champs\" />";
			echo "<input type=\"hidden\" value=\"".$ligne."\" name=\"lignes\" />";
			echo '<input type="submit" value="OK" name="validerChamps" />';
			echo "</form>";
		}
		else
		{
			echo "Fichier déjà existant";
	?>

			<form action="appli" method="get">
				<input type="hidden" name="dir" value="<?php echo Session::get('dossCourant'); ?>" />
				<input type="submit" value="OK" name="valider" />
			</form>
	</fieldset>
<?php
		}
	}
}
?>
</body>
</html>