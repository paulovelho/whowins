<?php

	if(@$_POST["query"]){
		$people = explode("\n", $_POST["query"]);
		PersonControl::Truncate();
		foreach ($people as $p) {
			$p = explode(";", $p);
			$person = new Person();
			$person->name = $p[0];
			$person->tags = $p[1];
			$person->category_id = $p[2];
			$person->peso = 1;
			echo "inserting: ".$person->name."...<br/>";
			$person->Insert();
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
			name; tag1, tag2; category_id
			Darth Vader; vilao, starwars; 4<br/>
			Agent Carter; ;5<br/>
			Uma pessoa por linha...<br/>
			<br/><br/>
		</div>
	</div>
</div>

<script type="text/javascript">
	function updateFields(){
		var data = { 
			query: $("#data").val()
		}
		MagratheaPost("update-persons.php", data);
	}

</script>
