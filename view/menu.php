<?php

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHB Newsletter - Menu</title>
	<style type="text/css">
		html {height: 100%;}
		body {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom, rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg, #670d10 0%,#092756 100%);
		}
		.btnMenu {
			width: 300px;
			height: 40px;
			background-color: #4a77d4;
			background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4);
			background-repeat: repeat-x;
			color: white;
			border-radius: 5px;
			margin-top: 20px;
			text-align: center;
			line-height: 35px;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<img src="./ressources/logo-phb.png" style="width: 200px; height: auto;">
	<a href="#" class="btnMenu">Créer une Newsletter</a>
	<a href="#" class="btnMenu">Envoyer une Newsletter</a>
	<a href="./routeur.php?a=mailinglist" class="btnMenu">Afficher la mailing list</a>
	<a href="#" class="btnMenu">Ajouter un email</a>
	<a href="./routeur.php?a=addacct" class="btnMenu">Ajouter un compte</a>

</body>
</html>