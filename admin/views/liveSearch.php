<?php
$name = $_POST['name'];
require_once("../models/mdlProductos.php");
$b = new mdlProductos();
$data = $b->mdlLiveSearch($name);

echo json_encode($data);