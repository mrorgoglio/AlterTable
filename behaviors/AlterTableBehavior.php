<?php

class AlterTableBehavior extends CBehavior{
    
	private $owner;
	
	public function alterTable($attributes) {
		
		$this->owner = $this->getOwner();
		$builder=new AdvancedDbCommandBuilder($this->owner);
		$table=$this->owner->getMetaData()->tableSchema;
		$command=$builder->createAlterCommand($table,$attributes);
		if($command->execute())
			return true;
		return false;
	}
}

?>