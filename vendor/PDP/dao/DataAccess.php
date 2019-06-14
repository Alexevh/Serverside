<?php
namespace dao;

/* Es un singleton*/
class DataAccess extends \Zend_Db_Adapter_Mysqli{
    
    static private $instance = null;
    
    public static function getInstance($Config)
    {
        
        /* Si no existe la instancia conectada a la DB.*/
        if (!isset(self::$instance))
        {
            $Clase = __CLASS__;
            self::$instance = new $Clase($Config->database->toArray());
        }
        
        return self::$instance;
    }
    
    
    public function execute($sql, $binds= array())
    {
        $Dar = new DataAccessResult($this, $sql);
        $Dar->_execute($binds);
    }
    
    public function retrieve($sql, $binds){
        $Dar = new DataAccessResult($this, $sql);
        //die(print_r($binds));
        $Dar->_execute($binds);
        //die("llegue acaj");
        return $Dar;
    }
    
    
    
}
