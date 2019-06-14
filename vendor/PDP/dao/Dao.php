<?php

namespace dao;

use patterns\ServiceLocator;
use patterns\strategy\Query;

class Dao {

    public $DataAccess = null;

    public function __construct() {
        $Config = ServiceLocator::getConfig();
        $this->DataAccess = DataAccess::getInstance($Config);
    }

    public function create($Model) {
        $binds = array();
        foreach ($Model->toArray() as $atributo => $valor) {
            /* solo grabe datos escalares, ni arrays ni objetos */
            if (!is_object($valor)) {
                $binds[$atributo] = $valor;
            }
        }

        $reflect = new \ReflectionClass($Model);
        /* por ejemplo tabla device */
        $tabla = strtolower($reflect->getShortName());

        try {

            //die("llegue aca")
            print_r($binds);
            $this->DataAccess->insert($tabla, $binds);
            $Model->id = $this->DataAccess->lastInsertId($tabla, 'id');
        } catch (\Exception $e) {
            //$Translator = ServiceLocator::getTranslator();
            /* log del error en el archivo errores */
            throw new \Exception("HUbo un error al insertar " . $e->getMessage());
        }
    }

    //Q es Query
    public function load($Model, $Q) {
        try {


            $result = $Q->preparar($Model);
            //die("estpy aca".$result);
            $Dar = $this->DataAccess->retrieve(
                    $result->select . $result->query, $result->binds
            );

            if ($row = $Dar->fetch()) {
                foreach ($row as $key => $value) {
                    $Model->$key = $value;
                }
                //aviso que el modelo se cargo.
                return true;
            }
            return false;
        } catch (\Exception $e) {
            //log del error en el archivo de errores.
            //notificar por SMS, EMAIL el error.
            //die($e->getMessage());
            //validar que $e->getCode() sea un http code valido
            // throw new \Exception($Translator->_("error_db_working_on_that"));
            throw new \Exception("ERROR" . $e->getMessage());
        }
    }

    public function delete($Model) {

        $binds = array($Model->id);

        $reflect = new \ReflectionClass($Model);
        //$reflect = new \ReflectionClass($Model);

        $tabla = strtolower($reflect->getShortName());
        $sql = "delete from $tabla where id = ?";
        $this->DataAccess->execute($sql, $binds);
    }

    public function update($Model) {

        $id = $Model->id;

        $binds = array();
        foreach ($Model->toArray() as $atributo => $valor) {
            /* solo grabe datos escalares, ni arrays ni objetos */
            if (!is_object($valor)) {
                $binds[$atributo] = $valor;
            }
        }

        $reflect = new \ReflectionClass($Model);
        /* por ejemplo tabla device */
        $tabla = strtolower($reflect->getShortName());

        try {


            print_r($binds);
            //die("llegue aca");
            $this->DataAccess->update($tabla, $binds, "id='$id'");
            // $Model->id = $this->DataAccess->lastInsertId($tabla, 'id');
        } catch (\Exception $e) {
            //$Translator = ServiceLocator::getTranslator();
            /* log del error en el archivo errores */
            throw new \Exception("HUbo un error al insertar " . $e->getMessage());
        }
    }

    public function fetch($Q, $Model) {

        try {
            $result = $Q->preparar($Model);
            //die("estpy aca".$result);
            $Dar = $this->DataAccess->retrieve(
                    $result->select . $result->query, $result->binds
            );

            return $Dar->fetchAll();
        } catch (\Exception $e) {
            //log del error en el archivo de errores.
            //notificar por SMS, EMAIL el error.
            //die($e->getMessage());
            //validar que $e->getCode() sea un http code valido
            // throw new \Exception($Translator->_("error_db_working_on_that"));
            throw new \Exception("ERROR" . $e->getMessage());
        }
    }

}
