<?php

class ProductoController extends Zend_Rest_Controller
{
    /* El index del REST nos lista los productos*/
    public function indexAction() {
        
        
        /* Creo una instancia de la clase Config*/
        $Config = new Zend_Config_Ini(APP.DS.'config'.DS."config.ini", APPLICATION_ENV);
        
        die(" El pasword es ".$Config->pwd);
        
        
        die("Esty en el index del producto");
    }
    
    public function postAction() {
        die("Esty en el postaction del producto");
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