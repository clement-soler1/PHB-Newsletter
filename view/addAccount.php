<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHB Newsletter - Comptes</title>
	<style type="text/css">
		html {height: 100%;}
		body {
			height: 98%;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom, rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg, #670d10 0%,#092756 100%);
		}
		#acctList {
			width: 500px;height: 300px;
			background-color: white;
			overflow-y: auto;
		}
		.acct {
			display: flex;
			flex-direction: row;
			margin-left: 10px;
		}
		.acct > img {
			width: 16px;
			height: auto;
			margin-left: 10px;
			cursor: pointer;
		}
		.acct > p {margin: 0; margin-top: 10px;}
		#divaddform {
			margin-top: 50px;
			border: solid 2px white;
			border-radius: 4px;
			padding: 20px;
		}
	</style>
</head>
<body>
	<div id="acctList">
		<!--<div class="acct"><p>clement.soler2000@gmail.com</p><img src="./ressources/trash.svg" onclick="deleteUser("")"></div>-->
		<?php
			$accts = Model::getAllAccount();
			foreach ($accts as $acct) {
				//echo '<p class="mail" onclick="resetSelect();this.classList.add(`selected`)">'. $acct["mail"] .'</p>';
				echo '<div class="acct"><p>'. $acct["mail"] .'</p><img src="./ressources/trash.svg" onclick="deleteUser('. $acct["idUser"] .')"></div>';
			}
		?>
	</div>
	<div id="divaddform">
		<form method="post" action="./routeur.php">
			<input type="email" name="u" required placeholder="Email">
			<input type="text" name="s" required placeholder="Signature">
			<input type="password" name="p" required placeholder="Mot de passe" minlength="4">
			<input type="hidden" name="a" value="createacct">
			<input type="submit" value="Créer">
		</form>
	</div>
	<script type="text/javascript">
		function deleteUser(id) {
			if (confirm("Etes-vous sur de vouloir supprimer le compte ?")) {

			    //document.location.href = "routeur.php?a=delacct&u" + mail;
			    var req = new XMLHttpRequest();

			    req.onload = function () {
				    // do something to response
				    console.log(this.responseText);
				};

			    req.open("POST","./routeur.php?");
			    req.addEventListener('loadend', () => {
			    	window.location.href = "./routeur.php?a=addacct";
			    });
			    var data = new FormData();
			    data.append("a","delacct");
			    data.append("u",id);
			    req.send(data);



			}
		}
	</script>
</body>
</html>