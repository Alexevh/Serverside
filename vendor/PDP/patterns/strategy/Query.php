<?php

namespace patterns\strategy;

class Query {
    
    
    public function __construct($Model) {
        $this->Model = $Model;
        $this->result = new \StdClass();
    }
    
    public function add($Statement)
    {
        $this->statements[]= $Statement;
    }
    
    //invoca a cada statament metodo preparar()
    public function preparar(){
        
        $this->binds = array();
        $this->query = null;
        
        if(is_array($this->statements) && !empty($this->statements)){
            
            foreach($this->statements as $pos=>$Statement)
            {
                $Statement->preparar($this, $pos);
            }
        }
    }
    
    
}