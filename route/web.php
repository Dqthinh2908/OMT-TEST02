<?php
// index.php?c=home&m=index;
$pathController = "app/controller/";
$namespaceController = "app\\controller\\";

$c = ucfirst($_GET['c'] ?? 'home');
$nameController = "{$c}Controller";
$fileNameController = "{$pathController}{$nameController}.php";
$objectController = $namespaceController.$nameController;
$m = trim($_GET['m'] ?? 'index');

if(file_exists($fileNameController)){
    $controller = new $objectController;
    $controller->$m();
}else
{
    exit('Not found request');
}


?>