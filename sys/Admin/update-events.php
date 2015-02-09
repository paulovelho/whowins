<?php

	if(@$_POST["query"]){
		$events = explode("\n", $_POST["query"]);
		EventControl::Truncate();
		$event = new Event();
		$event->question = "Quem ganharia num confronto entre:";
		$event->active = 1; $event->peso = 1;
		echo "inserting: ".$event->question."...<br/>";
		$event->Insert();
		foreach ($events as $ev) {
			$ev = trim($ev);
			$event = new Event();
			$event->question = $ev;
			$event->active = 1; $event->peso = 1;
			echo "inserting: ".$event->question."...<br/>";
			$event->Insert();
		}
		echo "<br/><br/><hr/>";
	}

?>

<div class="row-fluid">
	<div class="span9">
		<textarea id="data" class="input-xxlarge" style="height: 400px;"></textarea>
	</div>
	<div class="span3">
		<button class="btn btn-success" onClick="updateEvents();">
			<i class="fa fa-save"></i> Salvar
		</button>
		<br/><br/>
		<h4>Format:</h4>
		<div style="border: 1px solid #555; padding: 3px;">
			Quem ganharia...<br/>
			Quem seria...<br/>
			Um evento por linha...<br/>
			<br/><br/>
		</div>
	</div>
</div>

<script type="text/javascript">
	function updateEvents(){
		var data = { 
			query: $("#data").val()
		}
		MagratheaPost("update-events.php", data);
	}

</script>
