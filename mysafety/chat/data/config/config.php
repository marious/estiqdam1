<?php 

$configArr = array(
	'engine_path' => '../engine/', 
	'root_path' => '/', 
	'domain' => 'localhost' 
); 



function PDO_CONNECT(){ 
    $PDO = new PDO('mysql:host=localhost;dbname=livechat2', 'root', '2634231'); 
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); 
    return $PDO; 
}