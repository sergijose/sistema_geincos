<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/marcas.controlador.php";
require_once "controladores/modelos.controlador.php";


require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/marcas.modelo.php";
require_once "modelos/modelos.modelo.php";




$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();