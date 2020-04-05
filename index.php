<?php

require('classes/user.php');
require('classes/provider.php');
require('classes/customer.php');

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

        $userObj->insertUser();

        if ($userObj->getRol() == 1) { //Cutomer
            $customer = new Customer();
            $customer->setName($_POST['realName']);
            $customer->setAddress($_POST['address']);
            $customer->setUserId($userObj->getId());
            $jsonResponse = $customer->insertCustomer();
        } else if ($userObj->getRol() == 2) { //Provider
            $provider = new Provider();
            $provider->setName($_POST['realName']);
            $provider->setService($_POST['service']);
            $provider->setAddress($_POST['address']);
            $provider->setScheduleId($_POST['schedule']);
            $provider->setUserId($userObj->getId());
            $jsonResponse = $provider->insertProvider();
        }

        //$jsonResponse = 
    } else if ($action == "logIn") {
        $userObj->setUserName($_POST['name']);
        $userObj->setPassword($_POST['password']);

        $logInFlag = $userObj->logIn();        

        if ($logInFlag['status']) {
            if ($logInFlag['role'] == 2) { //Provider
                $provider = new Provider();

                $jsonResponse = $provider->getProviderByUserId($userObj->getId());
                
            } else if ($logInFlag['role'] == 1) { //Customer
                $customer = new Customer();

                $jsonResponse = $customer->getCustomerByUserId($userObj->getId());
            }
        }

        //We also need to return the role
        $jsonResponse['role'] = $logInFlag['role'];
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
