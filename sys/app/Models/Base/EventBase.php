<?php

## FILE GENERATED BY MAGRATHEA.
## SHOULD NOT BE CHANGED MANUALLY

class EventBase extends MagratheaModel implements iMagratheaModel {

	public $id, $question, $peso, $active;
	public $created_at, $updated_at;
	protected $lazyLoad = true;

	public function __construct(  $id=0  ){ 
		$this->Start();
		if( !empty($id) ){
			$pk = $this->dbPk;
			$this->$pk = $id;
			$this->GetById($id);
		}
	}
	public function Start(){
		$this->dbTable = "events";
		$this->dbPk = "id";
		$this->dbValues["id"] = "int";
		$this->dbValues["question"] = "string";
		$this->dbValues["peso"] = "int";
		$this->dbValues["active"] = "int";


		$this->dbAlias["created_at"] =  "datetime";
		$this->dbAlias["updated_at"] =  "datetime";
	}

	// >>> relations:

}

class EventControlBase extends MagratheaModelControl {
	protected static $modelName = "Event";
	protected static $dbTable = "events";
}
?>