
<?php
 function test($modele, $sujet) 
{
	       
		if(preg_match($modele, $sujet)) 
		{
            return true;
        }
		else
		{
			return false;
		}

}
 var_dump(Session::all());
 echo"***";
 var_dump(Input::all());
echo"***";
 var_dump(Input::old());
$ligne=Input::get('lignes');
 $nombre=Input::get('champs');
 $liste=Input::all();
 $fichierCsv=Session::get('dossCourant')."/".Input::get('nom');
 echo "nom".input::old('nom')." chemin ".Session::get('dossCourant')." = ".$fichierCsv;
$nom = array();
  $type = array();// echo  $fichierCsv;
 echo "<h3>Saisie des donnees</h3>";
echo '<form action="ecritFichier" method="post">';
echo "<input type=\"hidden\" value=\"".$fichierCsv."\" name=\"fichierCsv\" />";		
echo "<input type=\"hidden\" value=\"".Input::get('nom')."\" name=\"nom\" />";		
//récupération des couples nom-type
 		foreach ($liste as $cle => $val) 
		{
			//print "$cle = $val\n";
		
			if(test("#nomChamp#", $cle))
			{
				$nom[]=$val;
			}
			if(test("#typeChamp#", $cle))
			{
				$type[]=$val;
			}
		}

//création du masque de saisie		
echo "<table border=\"1\"><tr>";

//en-tete
 for ($i=0;$i<$nombre;$i++)
 {
 echo "<td>".$nom[$i]."</td>";
 echo "<input type=\"hidden\" value=\"".$nom[$i]."\" name=\"champ0".$i."\" /></td>";
}
echo "</tr>";
//types
for ($i=0;$i<$nombre;$i++)
{
	echo "<input type=\"hidden\" value=\"".$type[$i]."\" name=\"champ1".$i."\" />";
}
echo "</tr>";
//corps
for ($j=2;$j<$ligne;$j++)
{
	for ($i=0;$i<$nombre;$i++)
	 {
	 
	 echo "<td><input type=\"".$type[$i]."\" name=\"champ".$j.$i."\" /></td>";
	 
	}
	echo "</tr>";
}
echo"</table>";
echo "<input type=\"hidden\" value=\"".$ligne."\" name=\"nbrLigne\" />";
echo "<input type=\"hidden\" value=\"".$ligne."\" name=\"nbrLigne\" />";
echo "<input type=\"hidden\" value=\"".$nombre."\" name=\"nbrChamp\" />";
echo '<input type="submit" name="finsaisie" value="Enregistrer" />';
echo '</form>';

 ?>