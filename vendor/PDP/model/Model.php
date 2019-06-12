<?php

namespace model;
use patterns\ServiceLocator;
use dao\Dao;

class Model {
    
    public $id = null;
    public $created = null;
    public $updated = null;
    //public $Config = null;
    public $Dao = null;
    
    
    public function __construct() {
       $this->Config = ServiceLocator::getConfig();
       $this->Dao = new Dao();
    }
    
    /* Convierto la clase en un aray y la devuelvo*/
    public function toArray()
    {
        $ret = array();
        
        /* Obtengo el atributo valor modelo */
        foreach(get_object_vars($this) as $key=>$value)
        {
            if(!is_object($value) && !is_array($value))
            {
                $ret[$key]=$value;
            }
            
        }
        
        return $ret;
    }
    
    public function create()
    {
        $this->created = date("Y-m-d H:i:s");
        $this->Dao->create($this);
    }
    
    public function delete()
    {
        $this->Dao->delete($this);
    }
    
    public function update()
    {
        $this->updated = date("Y-m-d H:i:s");
        $this->Dao->update($this);
    }
    
    public function save()
    {
        if ($this->id)
        {
            $this->update();
        } else {
            $this->create();
        }
    }
}