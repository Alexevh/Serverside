<?php

namespace rest\controller;

class Rest extends \Zend_Rest_Controller {
    
    
    public function getHeader($name)
    {
        return $this->getRequest()->getHeader($name);
    }
    
    public function error(\Exception $e)
    {
        //die($e->getCode());
        $this->getResponse()->setHttpResponseCode($e->getCode());
        $resultado = array("status"=>1, "Descripcion"=>$e->getMessage());
        $resultado = \Zend_Json_Encoder::encode($resultado);
        exit($this->getResponse()->appendBody($resultado));
    }
    
    public function init()
    {
        //die("entra al init "); 
        $this->getResponse()->setHeader('Content-type', 'application/json');  
        $this->lang = $lang = ($this->getHeader("lang"))?$this->getHeader("lang"):"es";
    }
    
    public function getParam($name){
        $raw = $this->getRequest()->getRawBody();       
        $raw = \Zend_Json_Decoder::decode($raw); 
        return  $raw[$name];
    }


    /* El index del REST nos lista los productos*/
    public function indexAction() {
           
        
        die("Esty en el index del controlador por defecto");
    }
    
    public function postAction() {
        die("Esty en el postaction del controlador por defecto");
    }
    
    public function putAction() {
        $this->getResponse()->setHeader('Content-type', 'application/json');   
       
        $this->getResponse()->setHttpResponseCode(404);
        $response = array("status"=>0, "descripcion"=>"No se puede poner");
        $response = \Zend_Json_Encoder::encode($response);
        exit($this->getResponse()->appendBody($response));
    }
    
    public function deleteAction() {
          die("Esty en el delete del controlador por defecto");
         
          
    }
     public function getAction() {
         
         
          die("Esty en el get del controlador por defecto ");
          
    }
    
     public function headAction() {
          die("Esty en el head del controlador por defecto");
          
    }
}
