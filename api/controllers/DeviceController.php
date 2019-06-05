<?php

use rest\controller\Rest;
use models\Device;

class DeviceController extends Rest {
    /* El index del REST nos lista los productos */

    public function indexAction() {
        /* Vamos a especificar que el tipo de contenido que devolvemos es JSON */
        $this->getResponse()->setHeader('Content-type', 'application/json');

        try {
            /* Creo una instancia de la clase Config */
            $Config = new Zend_Config_Ini(APP . DS . 'config' . DS . "config.ini", APPLICATION_ENV);      
            $Device = new Device();
            $this->getResponse()->setHttpResponseCode(200);
            $data = array("status"=>0, "DESCRIPCION"=>$Device->obtenerTodo());
            $data = \Zend_Json::encode($data);
            exit($this->getResponse()->appendBody($data));
             
        } catch (exception $e) {
            $this->getResponse()->setHttpResponseCode($e->getCode());
            $resultado["status"] = 1;
            $resultado["descripcion"] = $e->getMessage();
            $resultado = Zend_Json::encode($resultado);
            exit($this->getResponse()->appendBody($resultado));
        }
    }

    /* Vamos a recibir parametros para crear un producto */

    public function postAction() {

        /* Vamos a especificar que el tipo de contenido que devolvemos es JSON */
        $this->getResponse()->setHeader('Content-type', 'application/json');
        //die("post");
        try {
            /* Recibo los parametros del cliente */
            //$raw = $this->getRequest()->getRawBody();       
            //$raw = Zend_Json_Decoder::decode($raw); 
            /**/
            $os = $this->getParam("os");
            $status = $this->getParam("status");

            $os_validos = array("android", "ios");
            $estados_validos = array("activo", "inactivo");

            /* El UUID viene en el header */
            //$uuid = $this->getRequest()->getHeader("uuid");
            $uuid = $this->getHeader("uuid");

            if (empty($uuid)) {
                throw new Exception("Error, se requiere UUID", 409);
            }

            if (!in_array($os, $os_validos)) {
                throw new Exception("Error, sistema operativo no soportado", 409);
            }

            if (!in_array($status, $estados_validos)) {
                throw new Exception("Error, status  no soportado", 409);
            }

            $Device = new Device();
            $Device->os = $os;
            $Device->status = $status;
            $Device->uuid = $uuid;
            $Device->create();


            echo("Se dio de alta $os , $status");
            exit();
        } catch (Exception $e) {
            die(ERR . $e->getMessage());
            $this->error($e);
        }
    }

}
