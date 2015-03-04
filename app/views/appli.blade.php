@extends('modele_base')


@section('contenu')

<?php
//initialisation
$BASE =$_SERVER['DOCUMENT_ROOT']."/SIW2014-1/app/documents/". Auth::user()->util_pseudo;
$PHP_SELF=$_SERVER['PHP_SELF'];




//si la page est charg�e suite au clic sur un dossier, on r�cup�re $dir 
if (Input::has('dir')) 
{
	$dir=Input::get('dir');
	Session::put('dossCourant', $dir);
}
elseif (Session::has('dosscourant'))//sinon si la session contient le dossier couranr
{
	$dir = Session::get('dosscourant');
}
else//sinon (1ere entr�e ) on initialise
{
	$dir =$BASE;
	Session::put('dossCourant', $BASE);
}
//listage des dossiers (partie gauche)
function list_dir($base, $cur, $level=0) {
  global $PHP_SELF, $BASE;
  if ($dir = opendir($base)) {
    while($entry = readdir($dir)) {
      /* chemin relatif � la racine */
      $file = $base."/".$entry;
      if(is_dir($file) && !in_array($entry, array(".",".."))) {
        /* marge gauche */
        for($i=1; $i<=(4*$level); $i++) {
            echo "&nbsp;";
        }
        /* l'entr�e est-elle le dossier courant */
        if($file == $cur) {//imafe dossier ouvert
          echo"<span id=\"doss_courant\"><img src=\"img/icone-dossier-ouvert.gif\"/>&nbsp; $entry</span><br />\n";
        } 
		else {//image dossier ferme
		  echo"<img src=\"img/icone-dossier-ferme.gif\"/>&nbsp; <a href=\"?dir=".rawurlencode($file)."\">$entry</a><br/>\n";
        }
        /* l'entr�e est-elle dans la branche dont le dossier courant est la feuille */
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
//listage fichiers et dossiers  (partie droite)
function list_file($cur) {
  if ($dir = opendir($cur)) 
  {
    while($file = readdir($dir)) 
	{
		if (!in_array($file, array(".","..")))
		{
			if(is_dir($cur."/".$file))
			{//c'est un dossier 
			  echo"<img src=\"img/icone-dossier-ferme.gif\"/>&nbsp;$file<br/>";
			}
			else//c'est un fichier
			{
				$lecteur=substr($cur, 0, 1);
				$doss=$lecteur.":".substr($cur, 2);
				//image fichier et lien vers la page de choix d'action
				echo"<a href=\"choixFichier?fichier=".$file."&dossier=".$doss."\" title=\"Ouvrir\"><img src=\"img/icone_fichier.png\"/></a>&nbsp;$file<br/>";
			}
		}
    }
    closedir($dir);
  }
}
?>
</br></br></br>
<center>
<table id="table_appli">
<tr valign="top">
<td>
<!-- liste des r�pertoires et des sous-r�pertoires -->
<?php 
/* lien sur la racine */
if(!isset($dir)) //dans ce cas il n'y a pas de dossier ouvert =>icone ferme sans lien
{
  echo "<img src=\"img/icone-dossier-ouvert.gif\"/>&nbsp;". Auth::user()->util_pseudo."<br />";
  Session::put('dossCourant', $BASE);
  //$dir = $BASE;
} 
else //il y a un dossier ouvert =>icone ouvert + lien de retour � la racine
{
  echo"<a href=\"?dir=$BASE\"><img src=\"img/icone-dossier-ouvert.gif\"/>&nbsp;". Auth::user()->util_pseudo."</a><br/>";//echo "aa<img src=\"img/icone-dossier-ferme.gif\"/>&nbsp; <a href=\"$PHP_SELF?dir=".$BASE."\">/</a><br />";
}
list_dir($BASE, rawurldecode($dir), 1);
?>

</td><td>

<!-- liste des fichiers -->
<?php
/* r�pertoire initial � lister */
if(!isset($dir)) 
{
  $dir = $BASE;
} 
list_file(rawurldecode($dir)); 
?>

</td></tr>
</table>

		<!-- bouton nouveau fichier -->
		&nbsp;
		<form action="nouveauFichier" method="post">
			<input type="submit" value="Nouveau fichier" name="nouvfich" />
		</form>&nbsp;
		<!-- bouton nouveau dossier -->
		<form action="nouveauDossier" method="post">
			<input type="submit" value="Nouveau dossier" name="nouvdoss" />
		</form>
@stop