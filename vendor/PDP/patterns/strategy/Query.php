<?php

namespace patterns\strategy;
use dao\Dao;

class Query{
	
	//$Statement es Qand,Qor,Qlike,Qin,etc
	public function add($Statement){
		$this->statements[] = $Statement;
	}
	
	public function __construct($Model){
		$this->Model = $Model;
		//voy a retornar un objeto con varios atributos para manipularlos
		$this->result = new \stdClass();//crea una variable de tip object
	}
	
	//este metodo es el strategy
	public function preparar(){
		$this->binds = array();
		$this->query = null;
		
		if(is_array($this->statements) && !empty($this->statements)){
			foreach($this->statements as $pos=>$Statment){
				//Escribime tu parte de consulta, estas en la pos $pos
				$Statment->preparar($this,$pos);
			}
		}
		//retorno objeto resultado
		$this->result->query 	= $this->query;
		$reflect = new \ReflectionClass($this->Model);
        //por ejemplo si modelo device -> tabla device.
        $tabla = strtolower($reflect->getShortName());
		$this->result->table 	= $tabla;
		//ToDo:Sacar * y poner nombres de campos.
		$this->result->select 	= "SELECT * FROM ".$this->result->table;
		$this->result->binds	= $this->binds;
		return $this->result;
	}
}