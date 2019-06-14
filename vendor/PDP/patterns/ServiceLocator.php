<?php

namespace patterns;
use dao\Dao;

class ServiceLocator {

    public static function getTranslator($lang = "es") {
        $Translator = new \Zend_Translate(
                array(
            "adapter" => "tmx",
            "content" => PROJECT . DS . "lang" . DS . "lang.tmx",
            "locale" => $lang
                )
        );

        return $Translator;
    }

    public static function getConfig() {
        try {
            $Config = new \Zend_Config_Ini(APP . DS . 'config' . DS . "config.ini", APPLICATION_ENV);
        } catch (\Exception $e) {
            try {
                $Config = new \Zend_Config_Ini(APP . DS . 'config' . DS . "config.ini", getenv("SERVER_ADDR"));
            } catch (\Exception $e2) {
                throw new \Exception("No hay fichero de configuracion valido " . $e2->getMessage());
            }
        }

        return $Config;
    }
    
    
    public static function getDAO($Model)
    {
        $reflect = new \ReflectionClass($Model);
        $modelo = $reflect->getShortName();
        $archivo = PROJECT.DS."daos".DS."$modelo.php";
        
        if (file_exists($archivo))
        {
            $Dao = "daos\\$modelo";
            //die("llegue aca".$Dao);
            $Dao = new $Dao();
            
        } else 
        {
            $Dao = new Dao();
           // die("llegue aca fuk");
        }
        
        return $Dao;
    }

}
