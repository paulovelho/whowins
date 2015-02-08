<?php

	include("inc/global.php");
	include($magrathea_path."/MagratheaAdmin.php");

	$admin = new MagratheaAdmin();
	$admin->Load();

//	MagratheaDebugger::Instance()->Show();

?>