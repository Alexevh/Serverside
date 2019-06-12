<?php

namespace patterns;

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

}
