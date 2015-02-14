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
	<legend><h3>Nouveau Dossier</h3></legend>
<?php
	//return var_dump(Input::all());
if (substr(Session::get('dossCourant'), -7)=="Partage")//tentative de creer un dossier dans le dossier "Partage"
{
	echo '<div>Création du dossier impossible dans le dossier "Partage"</div>';
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
			<form action="nouveauDossier" method="post">
				Nom du Dossier : <input type="text" name="nom" id="nomdoss" value="<?php echo Input::old('nom'); ?>"/><br />
	<?php
		if ($errors->has('nom'))
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
		$doss=Session::get('dossCourant')."/".Input::get('nom');
		if (!File::isDirectory($doss))//vérification de l'existence du dossier
		{
			mkdir($doss);
			echo "Création réussie";
	//		echo "<script >BoutonValider();</script>";
		}
		else
		{
			echo "Dossier déjà existant";
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