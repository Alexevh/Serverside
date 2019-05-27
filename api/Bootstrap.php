<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{

    protected function _initEnv(){
        $this->bootstrap("frontcontroller");
        $FrontController = Zend_Controller_Front::getInstance();
        $restRoute = new Zend_Rest_Route($FrontController);
        $FrontController->getRouter()->addRoute("default",$restRoute);
       
    }
}