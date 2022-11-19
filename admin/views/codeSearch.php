<?php
$codigo = $_POST['name'];
require_once("../models/mdlProductos.php");
$b = new mdlProductos();
$data = $b->mdlCodeSearch($codigo);

echo json_encode($data);