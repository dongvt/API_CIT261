<?php

require('classes/user.php');
require('classes/provider.php');

$action = $_POST['action'];
$table = $_POST['table'];
/**
 * User table interaction
 */
if ($table == "user") {
    $userObj = new User();
    if ($action == "insert") { // Insert a new user
        $userObj->setUserName($_POST['name']);
        $userObj->setPassword($_POST['password']);
        $userObj->setRol($_POST['rol']);

        $jsonResponse = $userObj->insertUser();
    } else if ($action == "logIn") { //LogIn (probably interact with more tables)
        $userObj->setUserName($_POST['name']);
        $userObj->setPassword($_POST['password']);

        $jsonResponse = $userObj->logIn();
    }
}
/**
 * Provider table interaction
 */
else if ($table == "provider") {
    $providerObj = new Provider();
    if ($action == "getList") {
        $jsonResponse = $providerObj->getProvidersList();
    }
}

echo json_encode($jsonResponse);
