

<?php

/* Este es el index.php del docente, la diferencia con el mio es que yo tengo en el
fichero de apache de configuracion un APP_ENV desarrollo en el setenv */
require_once "constantes.php";
require_once "autoload.php";
//ejemplo de como funciona autoload
//$una_instancia = new X_Y_Z_E_CLASE1;
$domain = $_SERVER['SERVER_NAME'];
//die($domain);
if(strpos($domain, "api") || strpos($domain, "api") === 0){
    //me invocan request a api.x.com por ejemplo
    $APP = "api";
}
define("APP",ROOT.DS."api");
//die(APP);
define("CONTROLLERS",APP.DS."controllers");
//Boostrap.php es lo primero que se ejecuta, cuando ingreso
//a cualquier applicacion.
define("BOOTSTRAP",APP.DS."Bootstrap.php");
//clase 2
set_include_path(VENDOR.PATH_SEPARATOR.get_include_path());
$app_env = getenv("APPLICATION_ENV");
//die($app_env);
//si no tengo variable de entorno APPLICATION_ENV
$app_env = (!empty($app_env))?$app_env:getenv("SERVER_ADDR");
//die($app_env);
define("APPLICATION_ENV", $app_env);
//ultima version de zend 1, 1.12
//creo una instancia de Application (api)
$application = new Zend_Application(APPLICATION_ENV, array('config'=>APP.DS."config".DS."config.ini"));
//ejecuto el bootstrap de la aplicacion
$application->bootstrap()->run();