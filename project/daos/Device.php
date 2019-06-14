<?php

namespace daos;

use model\Model;
use patterns\ServiceLocator;
use dao\Dao;

/*
 * TDAO ESPECIFICO DE DEVICE
 */

class Device extends Dao {

    public $uuid = null;
    public $status = null;
    public $os = null;
    public $modelo = null;
    public $cliente = null;

    
    /* Este metodo por ejenplo es propio de este DAO, como bien podria ser obtener
las peliculas mas vistas del a;o     */
    public function obtenerISHIT() {
        //die("LCDLL");
        $Config = new \Zend_Config_Ini(APP . DS . 'config' . DS . "config.ini", APPLICATION_ENV);
        $adapter = new \Zend_Db_Adapter_Mysqli($Config->database->toArray());

        /* Accedo al atributo seteado desde el controller */
        //$uuid = $this->uuid;
        $sql = " SELECT device.*, cliente.nombre, cliente.apellido
FROM device
LEFT JOIN cliente ON cliente.id = device.cliente
WHERE modelo LIKE '%IS%' ";
        /* El objeto que resulto de la consulta */
        $Statement = new \Zend_Db_Statement_Mysqli($adapter, $sql);
        /* Ejecuto el resultado */
        $Statement->_execute();

        /* Le pido un registro, fetch trae una sola columna */
        $row = $Statement->fetchAll();
        if ($row) {
            //die(print_r($row));
            return $row;
        } else {
            throw new \Exception("no hay datos");
        }
    }

}
