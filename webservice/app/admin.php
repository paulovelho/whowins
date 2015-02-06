<?php

	include("inc/global.php");
	include($magrathea_path."/Magrathea/MagratheaAdmin.php");

	$admin = new MagratheaAdmin();
	$admin->Load();

//	MagratheaDebugger::Instance()->Show();

?>