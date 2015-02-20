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
					<h1>Formapp - Gestion de formulaires</h1> (ajouter les logos)
				</div>

			</header>
			<nav id="menu">
				<div><input type="button" value="Deconnexion", name="bouton3" id="bouton3" onClick="BoutonDeconnecter()"/></div>
				<div><input type="button" value="Accueil", name="accueil" onClick="BoutonAnnuler()"/></div>
			</nav>
			<section id="contenu">
					<!--contenu de la page-->
					@yield('contenu')
			</section>
			<footer>

				<div id="basdepage">
					Licence Informatique Generale 2014/2015 
				</div>
			</footer>
		</div>
	</body>
</html>