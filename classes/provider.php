<?php

require_once('database/connection.php');

class Provider
{
    private $id;
    private $name;
    private $service;
    private $address;
    private $schedule_id;
    private $user_id;

    public function setName($userName)
    {
        $this->name = $userName;
    }

    public function setService($service)
    {
        $this->service = $service;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setScheduleId($schedule)
    {
        $this->schedule_id = $schedule;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getService()
    {
        return $this->service;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getScheduleId()
    {
        return $this->schedule_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function insertProvider()
    {
        $connObj = new Connection();
        $conn = $connObj->con();
        $sql = "INSERT INTO "
            . "providers (`providers_name`,`providers_service`,`providers_address`,`schedule_id`,`user_id`) "
            . "VALUES ("
            . "'" . $this->getName() . "',"
            . "'" . $this->getService() . "',"
            . "'" . $this->getAddress() . "',"
            . $this->getScheduleId() . ","
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

    public function getProvidersList()
    {
        $connObj = new Connection();
        $conn = $connObj->con();

        $sql = "SELECT * FROM providers "; //Need to get better 

        if ($result = mysqli_query($conn, $sql)) {
            $content = array();
            while ($row = $result->fetch_assoc()) {
                $providerRow = array(
                    "id" => $row['providers_id'],
                    "name" => $row['providers_name'],
                    "service" => $row['providers_service'],
                    "schedule" => $row['schedule_id']
                );
                array_push($content, $providerRow);
            }
            $message = array(
                "status" => true,
                "message" => $content
            );
        } else {
            $message = array(
                "status" => false,
                "message" => "Error: " . $sql . "" . mysqli_error($conn)
            );
        }
        return $message;
    }
}
