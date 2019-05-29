<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{

    protected function _initEnv(){
        $this->bootstrap("frontcontroller");
        $FrontController = Zend_Controller_Front::getInstance();
        
        $restRoute = new Zend_Rest_Route($FrontController);
        
        $FrontController->getRouter()->addRoute("default",$restRoute);
       
        /* Defino un fichero de log */
        $file_errors = "errors_".APPLICATION_ENV;
        $file_errors = APP.DS.'config'.DS."$file_errors.php";
 
        /* Si existe el fichero, lo incluye*/
        if(file_exists($file_errors))
        {
            require_once $file_errors;
        }
        
      
       
    }
    
    
    

}

