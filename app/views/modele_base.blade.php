<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="js/fonctions.js"></script>
		<title>Formapp-Gestion de formulaires</title>
	</head>
	<body>
		<div id="bloc_page">
			<header>

				<div id="titre_principal">
					<h1>Formapp - Gestion de formulaires</h1> 
				
				</div>

			</header>
			<nav id="menu">
			</br>
			<!--affichage du nom de l'utilisateur-->
			<h3 id="nom_util"><?php if (isset(Auth::user()->util_pseudo)) {echo(Auth::user()->util_pseudo);} else {echo '<br />';} ?></h3>
				<!--bouton de deconnexion-->
				<div><center><input type="button" value="Deconnexion", name="bouton3" id="bouton3" onClick="BoutonDeconnecter()"/></center></div>
				</br>
				<!--bouton de retour a l'accueil-->
				<div><center><input type="button" value="Accueil", name="accueil" onClick="BoutonAnnuler()"/></center></div>
				</br>
				</br>
				<br><br><center>
				<!--logos-->
				<img src="img/ccimartinique.jpg" width="150" height="100"></br><br>
				<img src="img/uag.jpg" width="150" height="100"></br><br>
				<img src="img/cnam.png" width="150" height="100">
				</center>
			</nav>
			<section id="contenu">
					<!--contenu de la page-->
					@yield('contenu')
			</section>
			<footer>

				<div id="basdepage">
					<center>Licence Informatique Générale 2014/2015</center>
				</div>
			</footer>
		</div>
	</body>
</html>