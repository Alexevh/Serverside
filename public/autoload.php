<?php

/*
 * Se basa en los estanades y recomendaciones de PHP-FIG, PSR4
 * WWW.PHP-FIG.ORG/PSR/
 */


/* Defino la clase autoloader para cargar las clases de zend */

class Autoloader {

    
    public static function cargarPDP($class)
    {
        $file_name = "";
        $name_space = "";
        $dir_name = "";
        
        /*  Si existe el gion me da la posicion de la primera ocurrencia */
        if ($pos = strripos($class,"\\")) {

            /* Zend_Validation_Email, cargo el nombre de la clase, en este caso email */
            $class_name = substr($class, $pos + 1);


            /* Cargo el namespace desde la posicion 0 a pos */
            $name_space = substr($class, 0, $pos);
            //echo $class_name, $name_space;

            /* constryo el directorio, reemplazo el guion bajo por el separador
              del sistema operativo */
            $dir_name = str_replace("\\", DS, $name_space);
            //DIE("La clase esta en ".$dir_name);
        }

        $dir_name .=DS."$class_name.php";
        
        //die($dir_name);
        $file_name = VENDOR.DS."PDP".DS.$dir_name;
        //die($file_name);
        //echo $file_name;
        /* me fijo si el archivo existe y  trato de incluirlo */
        if (file_exists($file_name)) {

            require_once $file_name;
        }
    }
    


    
    public static function CargarZend($class) {
        $file_name = "";
        $name_space = "";
        $dir_name = "";

        /*  Si existe el gion me da la posicion de la primera ocurrencia */
        if ($pos = strripos($class, "_")) {

            /* Zend_Validation_Email, cargo el nombre de la clase, en este caso email */
            $class_name = substr($class, $pos + 1);


            /* Cargo el namespace desde la posicion 0 a pos */
            $name_space = substr($class, 0, $pos);
            //echo $class_name, $name_space;

            /* constryo el directorio, reemplazo el guion bajo por el separador
              del sistema operativo */
            $dir_name = str_replace("_", DS, $name_space);
            //DIE("La clase esta en ".$dir_name);
        }

        $dir_name .=DS."$class_name.php";
        
        $file_name = VENDOR.DS.$dir_name;
        //die($file_name);
        //echo $file_name;
        /* me fijo si el archivo existe y  trato de incluirlo */
        if (file_exists($file_name)) {

            require_once $file_name;
        }
    }
    
    
    public static function CargarAPP($class) {
        $file_name = "";
        $name_space = "";
        $dir_name = "";

        /*  Si existe el gion me da la posicion de la primera ocurrencia */
        if ($pos = strripos($class, "\\")) {

            /* Zend_Validation_Email, cargo el nombre de la clase, en este caso email */
            $class_name = substr($class, $pos + 1);
            /* Cargo el namespace desde la posicion 0 a pos */
            $name_space = substr($class, 0, $pos);
            //echo $class_name, $name_space;
            /* constryo el directorio, reemplazo el guion bajo por el separador
              del sistema operativo */
            $dir_name = str_replace("\\", DS, $name_space);
            //DIE("La clase esta en ".$dir_name);
        }

        $dir_name .=DS."$class_name.php";
        //die($dir_name);
        $file_name = PROJECT.DS.$dir_name;
        //die($file_name);
        //echo $file_name;
        /* me fijo si el archivo existe y  trato de incluirlo */
        if (file_exists($file_name)) {

            require_once $file_name;
        }
    }

}




spl_autoload_register("Autoloader::CargarZend");
spl_autoload_register("Autoloader::cargarPDP");
spl_autoload_register("Autoloader::CargarAPP");
