<?php

class ErrorController  extends Zend_Controller_Action{
    
    public function errorAction(){
        $error = $this->getParam("error_handler");
        $exception = $error->exception;
        die($exception->getMessage());
    }
    
}
