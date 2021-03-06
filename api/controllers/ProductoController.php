<?php

class ProductoController extends Zend_Rest_Controller
{
    /* El index del REST nos lista los productos*/
    public function indexAction() {
        /* Vamos a especificar que el tipo de contenido que devolvemos es JSON*/
        $this->getResponse()->setHeader('Content-type', 'application/json');   
        
       try {
           
           if (1==1){
               throw new Exception("HUbo rror", 409);
           }
           
                
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
       
        /* Recibo los parametros del cliente*/
        $raw = $this->getRequest()->getRawBody();       
        $raw = Zend_Json_Decoder::decode($raw);
        
        /**/
        $nombre = $raw['nombre'];
        $precio = $raw['precio'];
        
        echo("dar de alta producto $nombre , $precio");
        
        
        exit();
    }
    
    public function putAction() {
          die("Esty en el putaction del producto");
    }
    
    public function deleteAction() {
          die("Esty en el delete del producto");
          
    }
     public function getAction() {
         
         $id = $this->getParam("id");
          die("Esty en el get del producto id $id");
          
    }
    
     public function headAction() {
          die("Esty en el head del producto");
          
    }
    
}