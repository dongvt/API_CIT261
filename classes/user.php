<?php

require_once('database/connection.php');

class User
{
    private $id;
    private $userName;
    private $password;
    private $rol;

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function getId()
    {
        return $this->id;
    }

    public function insertUser()
    {
        $connObj = new Connection();
        $conn = $connObj->con();
        $sql = "INSERT INTO "
            . "user (`user_name`,`user_password`,`role_id`) "
            . "VALUES ("
            . "'" . $this->getUserName() . "',"
            . "'" . $this->getPassword() . "',"
            . $this->getRol()
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
        //Practice a login to assign the id to the object
        $this->logIn();

        //Message arrow array with the status and the message
        return $message;
    }

    public function logIn()
    {
        $connObj = new Connection();
        $conn = $connObj->con();

        $sql = "SELECT "
            . "* FROM user "
            . "WHERE "
            . "user.user_name = '" . $this->getUserName() . "' AND "
            . "user.user_password = '" . $this->getPassword() . "'";

        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                //Aisgn id to the object
                if ($row = $result->fetch_assoc()) {
                    $this->id = $row['user_id'];
                }
                $message = array(
                    "status" => true,
                    "message" => ""
                );
            } else {
                $message = array(
                    "status" => false,
                    "message" => "User or Password incorrect"
                );
            }
        } else {
            $message = array(
                "status" => false,
                "message" => "Error: " . $sql . "" . mysqli_error($conn)
            );
        }
        return $message;
    }
}
