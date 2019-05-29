<?php

/* 
 * Como estamos en produccion no mostramos errores
 */

ini_set("display_errors", 0);

/* Log de error, no los muestro ni devuelvo al cliente */
ini_set("error_log", APP.DS."logs".DS."php".DS.date("d-m-Y"));