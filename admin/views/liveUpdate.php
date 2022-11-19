<?php
$productoUpdate = $_POST['productoUpdate'];
require_once("../models/mdlProductos.php");
$b = new mdlProductos();
$data = $b->mdlLiveUpdate($productoUpdate);

//echo json_encode($data);
echo $data;