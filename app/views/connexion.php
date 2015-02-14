<html>
<header>
<style>
form{
padding:200px;
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
</header>

<body bgcolor="#C4D7ED">
<form method="post" action="connexion">
<h1><FONT color="white" face="arial">Application  FORMAPP </FONT></h1>
		<h3>Veuillez vous identifiez :</h3>
<fieldset>
<legend><h3> Connexion </h3> </legend>
<legend>Nom d'Utilisateur : </legend> <input type="text" name="nom"/>
<legend>Mot de passe : </legend><input type="password" name="pass"/></br>
</br>
<input type="submit" name="valid" value="Connexion"/>
</fieldset>
<h3><?php if (isset($message)) {echo $message;} ?></h3>

</form>
</body>
</html>