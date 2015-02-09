<?php

	include("inc/global.php");

	include("Controls/_Controller.php");
	include("Controls/GameControl.php");

	MagratheaModel::IncludeAllModels();

	$game = GameControl::GetGame();

?>
<html>
	<head>
		<title>Who Wins?</title>
		<meta charset="utf-8">
	</head>

	<body>
		<center>
			<br/>
		<h1><?=$game["event"]->question?></h1>
			<br/>
		<h3><?=$game["players"][0]->name?></h3>
		<h4><?=($game["event"]->id == 1 ? "e" : "ou")?></h4>
		<h3><?=$game["players"][1]->name?></h3>
		<h1>?</h1>
		</center>
	</body>
</html>
