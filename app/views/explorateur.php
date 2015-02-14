<html>
<body>

<?php
$BASE = "../..";
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["dir"])) {$dir=$_GET["dir"];};
function list_dir($base, $cur, $level=0) {
//echo "**list_dir**";
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
          echo"<img src=\"icone-dossier-ouvert.gif\"/>&nbsp;$entry<br />\n";
        } else {
          echo"<img src=\"icone-dossier-ferme.gif\"/>&nbsp; <a href=\"$PHP_SELF?dir=".rawurlencode($file)."\">$entry</a><br/>\n";
        }
        /* l'entrée est-elle dans la branche dont le dossier courant est la feuille */
		$modele="#".$file."/#";
		$sujet=$cur."/";
//		echo $modele."**".$sujet;
        if(preg_match($modele, $sujet)) {
            list_dir($file, $cur, $level+1);
        }
      }
    }
    closedir($dir);
  }
}
function list_file($cur) {
//echo "**list_file**";
  if ($dir = opendir($cur)) {
    while($file = readdir($dir)) {
if(is_dir($cur."/".$file)){
  echo"<img src=\"icone-dossier-ferme.gif\"/>&nbsp;$file<br/>\n";
}else{
  echo"<img src=\"icone_fichier.png\"/>&nbsp;$file<br/>\n";
}
    }
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
if(!isset($dir)) {
  echo "/<br />";
  $dir = $BASE;
} else {
  echo "<a href=\"$PHP_SELF\">/</a><br />";
  
}
list_dir($BASE, rawurldecode($dir), 1);
?>

</td><td>

<!-- liste des fichiers -->
<?php
/* répertoire initial à lister */
if(!isset($dir)) {
  $dir = $BASE;
} 
list_file(rawurldecode($dir)); 
?>

</td></tr>
</table>

</body>
</html>
