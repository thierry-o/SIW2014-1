<style>
body{
font-family:Arial;
margin-left:35%;
margin-top:15%;
}
 input{
font-weight:bold;
background-color:#FFE4B5;
padding:3px;
border:1px solid #FF7F50;
border-radius:5px;}
h3{color:#FF4500;}
table{
	background-color:#FFE4B5;
	-moz-border-radius:8px;
    -webkit-border-radius:8px;	
    border-radius:8px;
border: 1px solid #FF7F50 ; 
border-spacing: 0px;
padding: 50px;
font-family:Arial;
font-size:20px;
}
</style>
<body>
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
//initialisation variables
$ligne=Input::get('lignes');
$nombre=Input::get('champs');
$liste=Input::all();
$fichierCsv=Session::get('dossCourant')."/".Input::get('nom');
$nom = array();
$type = array();// 
echo "<h3>Saisie des données du fichier ".Input::get('nom')."</h3>";
echo '<form action="ecritFichier" method="post">';
echo "<input type=\"hidden\" value=\"".$fichierCsv."\" name=\"fichierCsv\" />";		
echo "<input type=\"hidden\" value=\"".Input::get('nom')."\" name=\"nom\" />";		
//récupération des couples nom-type
foreach ($liste as $cle => $val) //on teste chaque variable
{
	if(test("#nomChamp#", $cle))//si le nom de variable est nomchamp**
	{
		$nom[]=$val;//on ajoute au tableau des noms
	}
	if(test("#typeChamp#", $cle))//si le nom de variable est typechamp**
	{
		$type[]=$val;//on ajoute au tableau des types
	}
}

//création du masque de saisie		
echo "<table><tr>";

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
echo"</br>";
echo '<input type="submit" name="finsaisie" value="Enregistrer" />';
echo '</form>';

 ?>
 </body>