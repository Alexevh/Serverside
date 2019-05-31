<?php

namespace rest\controller;

class Rest extends \Zend_Rest_Controller {
    
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
        $response = \Zend_Json::encode($response);
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
