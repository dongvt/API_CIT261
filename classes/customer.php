<?php

require_once('database/connection.php');

class Customer
{
    private $id;
    private $name;
    private $address;
    private $user_id;

    public function setName($userName)
    {
        $this->name = $userName;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function insertCustomer()
    {
        $connObj = new Connection();
        $conn = $connObj->con();
        $sql = "INSERT INTO "
            . "customer (`customer_name`,`customer_address`,`user_id`) "
            . "VALUES ("
            . "'" . $this->getName() . "',"
            . "'" . $this->getAddress() . "',"
            . $this->getUserId() 
            . ")";

        if (mysqli_query($conn, $sql)) {
            $message = array(
                "status" => true,
                "message" => ""
            );
        } else {
            $message = array(
                "status" => false,
                "message" => "Error: " . $sql . "" . mysqli_error($conn)
            );
        }

        //Message arrow array with the status and the message
        return $message;
    }

    public function getCustomerByUserId($userId) {
        $connObj = new Connection();
        $conn = $connObj->con();
        $sql = "SELECT * FROM customer WHERE customer.user_id = " . $userId; 

        $content = null;

        if ($result = mysqli_query($conn, $sql)) {
            
            while ($row = $result->fetch_assoc()) {
                $content = array(
                    "status" => true,
                    "id" => $row['customer_id'],
                    "name" => $row['customer_name'],
                    "address" => $row['customer_address'],
                    "userId" => $row['user_id']
                );
            }
        } else {
            $content = array(
                "status" => false,
                "message" => "Error: " . $sql . "" . mysqli_error($conn)
            );
        }
        return $content;
    }

}
