<?php

	require_once './lib/Security.php';
	require_once './config/Conf.php';
	require_once './php/Model.php';


	$bad_connect = array_key_exists("bc",$_GET);

	//var_dump($bad_connect);


	//Model::createAccount("clement.soler2000@gmail.com","Clément Soler","1234");
	//Model::getAccount("clement.soler2000@gmail.com","1234");
	//Model::addMail("test.soler2000@gmail.com");
	//$v = Model::getMailingList();
	//var_dump($v);
	//foreach ($v as $key) {
	//	var_dump($key);
	//}
?>

<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHB newsletter - Connexion</title>
	<link rel="stylesheet" type="text/css" href="./css/login-form.css">
</head>
<body>
	<img src="./ressources/logo-phb.png" style="position: absolute; left: 50%; top: 15%; width: 200px; height: auto; margin: -100px 0 0 -100px;">
	<div class="login">
	  <h1>PHB Newsletter</h1>
	    <form method="post" action="./routeur.php">
	      <input type="email" name="u" placeholder="Email" required="required" />
	        <input type="password" name="p" placeholder="Mot de passe" required="required" minlength="4"/>
	        <input type="hidden" name="a" value="menu">
	        <button type="submit" class="btn btn-primary btn-block btn-large">Se connecter</button>
	        <?php 
	        	if ($bad_connect) {
	        		echo '<p style="color: red;">Connexion échouée, veuillez réésayer !</p>';
	        	}
	        ?>
	    </form>
	</div>

</body>
</html>
