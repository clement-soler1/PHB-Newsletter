<?php
	//echo($_POST['u']);
	//echo($_POST['p']);

	require_once './lib/Security.php';
	require_once './config/Conf.php';
	require_once './php/Model.php';

	session_start();

	$action = $_REQUEST['a'];

	if ($action == "menu") {

		$usr = Model::getAccount($_POST['u'],$_POST['p']);
		//session_start();
		$_SESSION['usr'] = $usr;

		//var_dump($usr);

		if ($usr) {
			//require menu
			require("./view/menu.php");
		} else {
			header("Location: ./index.php?bc=true");
			session_destroy();
			exit();
		}
	}

	if ($action == "mailinglist") {
		if ($_SESSION['usr']) {
			require("./view/mailingList.php");
		}
	}

	if ($action == "addacct") {
		if ($_SESSION['usr']) {
			require("./view/addAccount.php");
		}
	}

	if ($action == "delacct") {
		if ($_SESSION['usr']) {
			//require("./view/addAccount.php");
			//to do
			//echo "slt";
			//var_dump($_POST["u"]);
			Model::deleteAccount($_POST["u"]);
			//require("./view/addAccount.php");
		}
	}

	if ($action == "createacct") {
		if ($_SESSION['usr']) {
			Model::createAccount($_POST['u'],$_POST['s'],$_POST['p']);
			require("./view/addAccount.php");
		}
	}
?>