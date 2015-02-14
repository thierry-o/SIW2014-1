
<?php
// var_dump(Session::all());
// echo"***";
// var_dump(Input::all());
//echo"***";
// var_dump(Input::old());
// echo "ok";
$fichier=Input::get('fichier');
//suppression du fichier
unlink($fichier);
//echo $donnees;
echo "<h3>Le ficher a ete supprime</h3>";
echo "<form action=\"appli\" method=\"get\">";
echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
echo '<input type="submit" value="OK"/>';
echo '</form>';
