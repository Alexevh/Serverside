<?php

use rest\controller\Rest;

class DeviceController extends Rest
{
    /* El index del REST nos lista los productos*/
    public function indexAction() {
        /* Vamos a especificar que el tipo de contenido que devolvemos es JSON*/
        $this->getResponse()->setHeader('Content-type', 'application/json');   
        
       try {
           
                
        /* Creo una instancia de la clase Config*/
        $Config = new Zend_Config_Ini(APP.DS.'config'.DS."config.ini", APPLICATION_ENV);       
        /* Vamos a devolver un formato JSON*/
        //$resultado = array("status"=>1000, "descripcion"=>"Hola");       
        /* Esta es otra forma de crear el array con las claves que quiero*/
        $resultado["status"]=1000;
        $resultado["descripcion"]="hola";     
         /* Conviero el array a JSON*/
        $resultado = Zend_Json::encode($resultado);      
        /* Con instancia de response envio el cuerpo del mensaje*/
        exit($this->getResponse()->appendBody($resultado));
           
       }catch (exception $e)
       {
           $this->getResponse()->setHttpResponseCode($e->getCode());
           $resultado["status"]=1;
           $resultado["descripcion"]=$e->getMessage();
           $resultado = Zend_Json::encode($resultado);  
           exit($this->getResponse()->appendBody($resultado));
       }
        
        
       
    }
    
    /* Vamos a recibir parametros para crear un producto*/
    public function postAction() {
       
        /* Vamos a especificar que el tipo de contenido que devolvemos es JSON*/
        $this->getResponse()->setHeader('Content-type', 'application/json');   
        
        /* Recibo los parametros del cliente*/
        $raw = $this->getRequest()->getRawBody();       
        $raw = Zend_Json_Decoder::decode($raw);
             
        
        /**/
        $os = $raw['os'];
        $status = $raw['status'];
        
        $os_validos = array("android", "ios");
        $estados_validos = array("activo", "inactivo");
        
        /* El UUID viene en el header*/
        $uuid = $this->getRequest()->getHeader("uuid");
        
        
        
        if (empty($uuid))
        {
          throw new Exception("Error, se requiere UUID", 409);
        }
        
        if (!in_array($os, $os_validos))
        {
          throw new Exception("Error, sistema operativo no soportado", 409);
        }
        
         if (!in_array($status, $estados_validos))
        {
          throw new Exception("Error, status  no soportado", 409);
        }
        
        echo("dar de alta producto $os , $status"); 
        exit();
        
        
    }
    
    
    
}