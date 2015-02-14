<html>
	<head>
	 
		<script type="text/javascript" src="js/fonctions.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
<body>

<?php
// var_dump(Session::all());
// var_dump(Input::all());
//initialisation
$BASE =$_SERVER['DOCUMENT_ROOT']."/SIW2014-1/app/documents/". Auth::user()->util_pseudo;
$PHP_SELF=$_SERVER['PHP_SELF'];




//si la page est chargée suite au clic sur un dossier, on récupère $dir 
if (Input::has('dir')) 
{
	$dir=Input::get('dir');
	Session::put('dossCourant', $dir);
}
elseif (Session::has('dosscourant'))//sinon si la session contient le dossier couranr
{
	$dir = Session::get('dosscourant');
}
else//sinon (1ere entrée ) on initialise
{
	$dir =$BASE;
	Session::put($BASE);
}
// var_dump(Session::all());
	
function list_dir($base, $cur, $level=0) {
  global $PHP_SELF, $BASE;
  if ($dir = opendir($base)) {
    while($entry = readdir($dir)) {
      /* chemin relatif à la racine */
      $file = $base."/".$entry;
      if(is_dir($file) && !in_array($entry, array(".",".."))) {
        /* marge gauche */
        for($i=1; $i<=(4*$level); $i++) {
            echo "&nbsp;";
        }
        /* l'entrée est-elle le dossier courant */
        if($file == $cur) {
          echo"<img src=\"img/icone-dossier-ouvert.gif\"/>&nbsp;$entry<br />\n";
        } 
		else {
		  echo"<img src=\"img/icone-dossier-ferme.gif\"/>&nbsp; <a href=\"?dir=".rawurlencode($file)."\">$entry</a><br/>\n";
        }
        /* l'entrée est-elle dans la branche dont le dossier courant est la feuille */
		$modele="#".$file."/#";
		$sujet=$cur."/";
        if(preg_match($modele, $sujet)) {
            list_dir($file, $cur, $level+1);
        }
      }
    }
    closedir($dir);
  }
}

function list_file($cur) {
  if ($dir = opendir($cur)) 
  {
    while($file = readdir($dir)) 
	{
		if (!in_array($file, array(".","..")))
		{
			if(is_dir($cur."/".$file))
			{
			  echo"<img src=\"img/icone-dossier-ferme.gif\"/>&nbsp;$file<br/>";
			}
			else
			{
				$lecteur=substr($cur, 0, 1);
				$doss=$lecteur.":".substr($cur, 2);
//echo $doss."/".$file;

				echo"<img src=\"img/icone_fichier.png\"/>&nbsp;$file<a href=\"lireFichier?fichier=".$doss."/".$file."\" title=\"Ouvrir\"><img src=\"img/modifier.png\" alt=\"Ouvrir\" \"></a>
				<a href=\"suppFichier?fichier=".$doss."/".$file."\" title=\"Supprimer\"><img src=\"img/supprimer.gif\" alt=\"Supprimer\" \"></a><br/> ";
				//<input type=\"image\" src=\"img/supprimer.gif\" class=\"bouton1\" onClick=\"BoutonSupprimer()\"><br/> ";
				
			}
		}
    }
//	echo "<img src=\"img/nouveau_fichier.png\" id=\"nouvfich\" onclick=\"NouvFich()\"/>&nbsp;<img src=\"img/nouveau_dossier.jpg\" id=\"nouvdoss\" onclick=\"NouvDoss()\"/>&nbsp;";
    closedir($dir);
  }
}
?>

<table border="1" cellspacing="0" cellpadding="10" bordercolor="gray">
<tr valign="top"><td>

<!-- liste des répertoires
et des sous-répertoires -->
<?php 
/* lien sur la racine */
if(!isset($dir)) //dans ce cas il n'y a pas de dossier ouvert =>icone ferme sans lien
{
  echo "<img src=\"img/icone-dossier-ouvert.gif\"/>&nbsp;". Auth::user()->util_pseudo."<br />";
  Session::put('dossCourant', $BASE);
  //$dir = $BASE;
} 
else //il y a un dossier ouvert =>icone ouvert + lien de retour à la racine
{
  echo"<a href=\"?dir=$BASE\"><img src=\"img/icone-dossier-ouvert.gif\"/>&nbsp;". Auth::user()->util_pseudo."</a><br/>";//echo "aa<img src=\"img/icone-dossier-ferme.gif\"/>&nbsp; <a href=\"$PHP_SELF?dir=".$BASE."\">/</a><br />";
}
list_dir($BASE, rawurldecode($dir), 1);
?>

</td><td>

<!-- liste des fichiers -->
<?php
/* répertoire initial à lister */
if(!isset($dir)) 
{
  $dir = $BASE;
} 
list_file(rawurldecode($dir)); 
?>

</td></tr>
</table>
		
		<form action="nouveauFichier" method="post">
			<input type="submit" value="Nouveau fichier" name="nouvfich" />
		</form>
		<form action="nouveauDossier" method="post">
			<input type="submit" value="Nouveau dossier" name="nouvdoss" />
		</form>
<!-- <input type="button" value="Nouveau fichier", name="bouton1" id="bouton1" onClick="BoutonNouvFich()"/>
<input type="button" value="Nouveau dossier", name="bouton2" id="bouton2" onClick="BoutonNouvDoss()"/> -->
<input type="button" value="Deconnexion", name="bouton3" id="bouton3" onClick="BoutonDeconnecter()"/>
</body>
</html>

