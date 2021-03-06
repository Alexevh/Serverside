<?php

use rest\controller\Rest;
use models\Device;
use patterns\ServiceLocator;

//Consultas
use patterns\strategy\Query;
use patterns\strategy\QAnd;
use patterns\strategy\QueryAbstract;
use patterns\strategy\QLike;

class DeviceController extends Rest {
    /* El index del REST nos lista los productos */

    public function indexAction() {
        
        
        $modelo = $this->getParam("modelo");
        $Device = new Device();
        //$RESULTADO = $Device->hola();
        
        if (!empty($modelo))
        {
            $Q = new Query($Device);
            $Q->add(new QLike("modelo", $modelo));
      
        }
         /* Vamos a especificar que el tipo de contenido que devolvemos es JSON */
        $this->getResponse()->setHeader('Content-type', 'application/json');
        // $respuesta = array("status"=>0, "descripcion"=>$Device->fetch($Q));
        //die(print_r($Device->hola()));
         $respuesta = array("status"=>0, "descripcion"=>$Device->consulta("ISH"));
         $this->response($respuesta, 200);
        
        
       

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
            $os = $this->getRawParam("os");
            $status = $this->getRawParam("status");

            $os_validos = array("android", "ios");
            $estados_validos = array("activo", "inactivo");

            $lang = $this->lang;
            //die($lang);

            $Translator = ServiceLocator::getTranslator($lang);

            /* El UUID viene en el header */
            //$uuid = $this->getRequest()->getHeader("uuid");
            $uuid = $this->getHeader("uuid");

            if (empty($uuid)) {
                throw new Exception($Translator->_("invalid_uuid"), 409);
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
            /* Ve rne el codigo del deocente redpsueta json */

            echo("Se dio de alta $os , $status");
            exit();
        } catch (Exception $e) {
            die($e->getMessage());
            $this->error($e);
        }
    }

    public function deleteAction() {
        /* Vamos a especificar que el tipo de contenido que devolvemos es JSON */
        $this->getResponse()->setHeader('Content-type', 'application/json');

        try {

            $lang = $this->lang;
            $Translator = ServiceLocator::getTranslator($lang);


            $id = $this->getParam("id");
            //die("me llego ".$id);
            if (empty($id)) {
                throw new \Exception($Translator->_("invalid_id", 409));
            }

            $Device = new Device();
            
            /* Cargo la query*/
            $Q = new Query($Device);
            $Q->add(new QAnd("id", $id));
            
            /* Esto carga el device por el ID valido de la BD, el id lo tiene*/
            if (!$Device->load($Q))
            {
                throw new \Exception("Status no valido");
            }
            $Device->id = $id;
            //die("me llego ".$id);
            $Device->delete();

            $respuesta = array("status" => 0, "descripcion" => array());


            $this->response($respuesta, 209);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function putAction() {
        /* Vamos a especificar que el tipo de contenido que devolvemos es JSON */
        $this->getResponse()->setHeader('Content-type', 'application/json');
        
        try {
            $os = $this->getRawParam("os");
            $status = $this->getRawParam("status");
            $uuid = $this->getHeader("uuid");
             $id = $this->getRawParam("id");
             
            $Device = new Device();
            
            /* Cargo la query*/
            $Q = new Query($Device);
            $Q->add(new QAnd("id", $id));
            
            /* Esto carga el device por el ID valido de la BD, el id lo tiene*/
            if (!$Device->load($Q))
            {
                throw new \Exception("Status no valido");
            }
            
            $Device->os = $os;
            $Device->status = $status;
            $Device->uuid = $uuid;
            $Device->id=$id;
            $Device->updated = Date("Y-m-m h:m:s");
            $Device->update();
            $respuesta = array("status" => 0, "descripcion" => array());


            $this->response($respuesta, 209);
        } catch (Exception $e) {
            $this->error($e);
        }
    }
    
    public function getAction() {
       
           /* Vamos a especificar que el tipo de contenido que devolvemos es JSON */
        $this->getResponse()->setHeader('Content-type', 'application/json');

        try {

            $lang = $this->lang;
            $Translator = ServiceLocator::getTranslator($lang);


            $id = $this->getParam("id");
            //die("me llego ".$id);
            if (empty($id)) {
                throw new \Exception($Translator->_("invalid_id", 409));
            }

            $Device = new Device();
            
            /* Cargo la query*/
            $Q = new Query($Device);
            $Q->add(new Qand("id", $id));
            
            /* Esto carga el device por el ID valido de la BD, el id lo tiene*/
            if (!$Device->load($Q))
            {
                throw new \Exception("Status no valido");
            }
            
            $respuesta = array("status" => 0, "descripcion" => $Device->toArray());


            $this->response($respuesta, 200);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

}
