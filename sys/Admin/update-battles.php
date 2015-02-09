<?php

	if(@$_POST["query"]){
		$battles = explode("\n", $_POST["query"]);
		BattleControl::Truncate();
		foreach ($battles as $p) {
			$p = explode(";", $p);
			$battle = new Battle();
			$battle->name = $p[0];
			$battle->level = $p[1];
			echo "inserting: ".$battle->name."...<br/>";
			$battle->Insert();
		}
		echo "<br/><br/><hr/>";
	}

?>

<div class="row-fluid">
	<div class="span9">
		<textarea id="data" class="input-xxlarge" style="height: 400px;"></textarea>
	</div>
	<div class="span3">
		<button class="btn btn-success" onClick="updateFields();">
			<i class="fa fa-save"></i> Salvar
		</button>
		<br/><br/>
		<h4>Format:</h4>
		<div style="border: 1px solid #555; padding: 3px;">
			name; level
			Deus; 3<br/>
			Google; 3<br/>
			Uma batalha por linha...<br/>
			<br/><br/>
		</div>
	</div>
</div>

<script type="text/javascript">
	function updateFields(){
		var data = { 
			query: $("#data").val()
		}
		MagratheaPost("update-battles.php", data);
	}

</script>
