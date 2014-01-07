<?php

class AlterTableBehavior extends CBehavior{
    
	private $owner;
	
	/*
	* AlterTable behavior
	* @param array $attributes the columns to be added
	*/
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