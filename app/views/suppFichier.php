
<?php
// var_dump(Session::all());
// echo"***";
// var_dump(Input::all());
//echo"***";
// var_dump(Input::old());
// echo "ok";
$fichier=Input::get('dossier')."/".Input::get('fichier');
//suppression du fichier
unlink($fichier);
//echo $fichier;
//récupération de l'id du fichier
$id = DB::table('fichier')->select('fich_id')->where('fich_nom', Input::get('fichier'))->where('fich_chemin', Input::get('dossier'))->first();
$num=intval($id->fich_id);
//suppression de la base de données
DB::table('partage')->where('part_fich_id', '=', $num)->delete();
DB::table('fichier')->where('fich_id', '=', $num)->delete();
//DB::delete('delete from partage')->where('fich_id', '==', '5');//$id->fich_id);
//DB::delete('delete from fichier')->where('fich_id', '5');// $id->fich_id);
echo "<h3>Le ficher a ete supprime</h3>";
echo "<form action=\"appli\" method=\"get\">";
echo '<input type="hidden" name="dir" value="'.Session::get('dossCourant').'" />';
echo '<input type="submit" value="OK"/>';
echo '</form>';
