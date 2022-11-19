<?php
require_once "controller/themeController.php";
require_once "controller/ctlrUsuarios.php";
require_once "controller/ctlrBrands.php";
require_once "controller/ctlrEqType.php";
require_once "controller/ctlrSocios.php";
require_once "controller/ctlrClientes.php";
require_once "controller/ctlrProviders.php";
require_once "controller/ctlrProductos.php";
require_once "controller/ctlrPublic.php";
require_once "controller/ctrVentas.php";
require_once "controller/ctlrMovimientos.php";
require_once "controller/ctlrSalidas.php";

require_once "models/mdlUsuarios.php";
require_once "models/mdlBrands.php";
require_once "models/mdlEqType.php";
require_once "models/mdlSocios.php";
require_once "models/mdlClientes.php";
require_once "models/mdlProviders.php";
require_once "models/mdlProductos.php";
require_once "models/mdlPublic.php";
require_once "models/mdlVentas.php";
require_once "models/mdlMovimientos.php";
require_once "models/mdlSalidas.php";
//require_once "controller/formularios.controller.php";
//require_once "controller/usuarios.controller.php";

//require_once "model/formularios.model.php";
//require_once "model/usuarios.model.php";

$theme = new themeController();
$theme -> theme(); 

