<?php
namespace patterns\strategy;
use patterns\QueryAbstract;

class QAnd extends QueryAbstract {
    
    public function __construct($campo, $valor) {
        
        if(is_array($campo))           
        {
            if (!empty($valor))
            {
                 $this->conditions=$campo;
            }
           
        } else 
        {
            $this->conditions[$campo]=$valor;
        }
        
    }
    
    //ejemplo, QAnd = new QAnd("nombre", "juan")
    public function preparar($Query, $pos)
    {
        $result = null;
        foreach($this->conditions as $campo=>$valor)
        {
            $result.="AND $campo = ?";
            $Query->binds[] =$valor;
        }
        //si es el primero no utilizo el AND
        $result =($pos==0)?substr($result, 4):$result;
        //si es el primro escribe el where
        $result =(is_null($Query->query))?" WHERE":$result;
        $Q->query .=$result;
    }
}