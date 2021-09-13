<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHB Newsletter - Mailing List</title>
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
		#mailinglist {
			width: 700px;height: 500px;
			background-color: white;
			overflow-y: auto;
		}
		#mailTool {
			margin-top: 50px;
			display: flex;flex-direction: row;
			align-items: center;justify-content: center;
		}
		.mail {
			margin-left: 10px;
		}
		.mail:hover {cursor: pointer;}
		.mail.selected {
			background-color: grey;
			color: white;
		}
	</style>
</head>
<body>
	<div id="mailinglist">
		<!--<p class="mail" onclick="resetSelect();this.classList.add(`selected`)">clement.soler2000@gmail.com</p>
		<p class="mail" onclick="resetSelect();this.classList.add(`selected`)">clement.soler2000@gmail.com</p>
		<p class="mail" onclick="resetSelect();this.classList.add(`selected`)">clement.soler2000@gmail.com</p>-->
		<?php
			$emails = Model::getMailingList();
			foreach ($emails as $mail) {
				echo '<p class="mail" onclick="resetSelect();this.classList.add(`selected`)">'. $mail["mail"] .'</p>';
			}
		?>
	</div>
	<div id="mailTool">
		<a href="#"><img src="./ressources/add.svg" style="width: 64px; height: auto; margin-right: 50px;"></a>
		<a href="#"><img src="./ressources/pencil.svg" style="width: 64px; height: auto; margin-right: 50px;"></a>
		<a href="#"><img src="./ressources/trash.svg" style="width: 64px; height: auto;"></a>
	</div>
	<script type="text/javascript">
		function resetSelect() {
			var elements = document.getElementsByClassName("selected");
			for (let el of elements) {
				el.classList.remove("selected")
			}
		}
	</script>
</body>
</html>