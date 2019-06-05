<?php
namespace models;
use model\Model;

class Device extends Model {
    
    
    public $uuid = null;
    public $status = null;
    public $os = null;
    
    
    public function create ()
    {
        
        $Config = new \Zend_Config_Ini(APP.DS.'config'.DS."config.ini", APPLICATION_ENV);  
        $adapter = new \Zend_Db_Adapter_Mysqli($Config->database->toArray());
        
        /*Accedo al atributo seteado desde el controller*/
        $uuid = $this->uuid;        
        $sql = "SELECT uuid FROM device where uuid = '$uuid'";
        /* El objeto que resulto de la consulta */
        $Statement = new \Zend_Db_Statement_Mysqli($adapter, $sql);
        /*Ejecuto el resultado*/
        $Statement->_execute();
        
        /* Le pido un registro, fetch trae una sola columna*/
        $row = $Statement->fetch();
        if ($row)
        {
            throw new \Exception ("El $uuid ya existe");
        } 
        
        $hoy = date("Y-m-d H:i:s");
        $os = $this->os;
        $status=$this->status;
        
        $sql = "INSERT INTO device (uuid, created, status, os) VALUES ('$uuid', '$hoy', '$status', '$os')";
        $Statement = new \Zend_Db_Statement_Mysqli($adapter, $sql);
        $Statement->_execute();
}

public function obtenerTodo()
{
      
        $Config = new \Zend_Config_Ini(APP.DS.'config'.DS."config.ini", APPLICATION_ENV);  
        $adapter = new \Zend_Db_Adapter_Mysqli($Config->database->toArray());
        
        /*Accedo al atributo seteado desde el controller*/
        $uuid = $this->uuid;        
        $sql = "SELECT * FROM device ";
        /* El objeto que resulto de la consulta */
        $Statement = new \Zend_Db_Statement_Mysqli($adapter, $sql);
        /*Ejecuto el resultado*/
        $Statement->_execute();
        
        /* Le pido un registro, fetch trae una sola columna*/
        $row = $Statement->fetchAll();
        if ($row)
        {
            return $row; 
            
        } else {
            throw new \Exception ("no hay datos");
        }
        
    
}
}