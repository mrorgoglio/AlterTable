<?php

	/**
	* @author Salvo Di Mare
	* @license GNU v2
	* @version 0.1
	*/
	
class AdvancedDbCommandBuilder extends CDbCommandBuilder {

	
	private $_schema;
	private $_connection;

	/**
	* @param CDbSchema $schema the schema for this command builder
	*/
	public function __construct($schema)
	{
		$this->_schema=$schema;
		$this->_connection=$schema->getDbConnection();
	}
	
	/**
	* Creates alter table command
	*
	* @param mixed $table the table schema ({@link CDbTableSchema}) or the table name (string)
	* @param array $columns the columns to be added
	*/
	public function createAlterCommand($table,$columns)
    {
		if (!is_array($columns))
			return;
			
	    $this->ensureTable($table);
	    $fields=array();
		$required=array('name','type','length');
			
		foreach($columns as $column)
	    {
	        if (array_intersect($required,array_keys($column))!==$required)
				return;
	        	
			if ($table->getColumn($column['name'])===null)
	        {
	        	$type = ($column['type']=='integer')? $type='INT' : $type='VARCHAR';
	        	$null = (isset($column['null']) AND $column['null'])? 'NULL' : 'NOT NULL';
				$default = (isset($column['default']) AND $column['default']|='None')? ($column['default']=='NULL' || $column['default']=='CURRENT_TIMESTAMP')? "DEFAULT ". $column['default']:"DEFAULT '".$column['default']."'" : '';
				$comment = (isset($column['comment']) AND $column['comment']|='None')? "COMMENT '".$column['comment']."'" : '';
				$fields[]= "ADD `".$column['name']."` ".$type."( ".$column['length']." ) ".$null. " ".$default." ".$comment;
	        }
		}
		$sql = "ALTER TABLE {$table->rawName} ".implode(', ',$fields);
		//echo $sql;
		$command=$this->_connection->createCommand($sql);
		return $command;
	}
		
	
}
?>
