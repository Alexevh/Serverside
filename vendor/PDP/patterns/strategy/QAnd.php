<?php
namespace patterns\strategy;
use patterns\strategy\QueryAbstract;

class Qand extends QueryAbstract{
	
	public function __construct($campo, $valor){
		if(is_array($campo) && !empty($campo)){
			$this->conditions = $campo;
		}
		elseif(!is_null($campo) && !is_null($valor)){
			$this->conditions[$campo] = $valor;
		}
	}
	//Ej:
	//Qand = new Qand('nombre','juan') o 
	//Qand = new Qand(array('nombre'=>'juan','appellido'=>'perez')
	
	//Q es el cliente en el strategy
	public function preparar($Q, $pos = 0){
		$result = null;
		if(is_array($this->conditions) && !empty($this->conditions)){
			//recorro campo,valor
			foreach($this->conditions as $field=>$value){
				$result .= " AND $field = ?";
				$Q->binds[] = $value;
			}
		//si es el primero no utilizo el primer AND
		$result = ($pos == 0)?substr($result, 4):$result;
		//si es la primer sentencia escribe el WHERE
		$result = (is_null($Q->query))?" WHERE $result":$result;
		}
		//le agrego a Q esta sentencia de consulta
		$Q->query .= $result;
	}
}