<?php

require('classes/user.php');

$action = $_POST['action'];

if ($action == "insertUser") {
    $userObj = new User();
    $userObj->setUserName($_POST['name']);
    $userObj->setPassword($_POST['password']);
    $userObj->setRol($_POST['rol']);
    
    $jsonResponse = $userObj->insertUser();
}
else if ($action == "logIn") {
    $userObj = new User();
    $userObj->setUserName($_POST['name']);
    $userObj->setPassword($_POST['password']);
    
    $jsonResponse = $userObj->logIn();
}

echo json_encode($jsonResponse);
?>