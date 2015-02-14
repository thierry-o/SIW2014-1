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
			echo "<legend><h3>Fichier : \"".Input::get('fichier')."\"</h3></legend>";
?>
			<form method="post" action="choixFichier">
			<p>
			
			<input type="radio" name="choix" checked="checked" /> Consulter<br />
			<input type="radio" name="choix"  /> Modifier<br />
			<input type="radio" name="choix"  /> Partager<br />
			<input type="radio" name="choix"  /> Renommer<br />
			<input type="radio" name="choix"  /> Supprimer<br />
			</p>
			<input type="submit" value="OK" />
			</form>
		</fieldset>
	</body>
</html>