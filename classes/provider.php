<?php

require_once('database/connection.php');

class Provider
{
    private $id;
    private $name;
    private $service;
    private $schedule;

    public function setName($userName)
    {
        $this->name = $userName;
    }

    public function setService($service)
    {
        $this->service = $service;
    }

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getService()
    {
        return $this->service;
    }

    public function getSchedule()
    {
        return $this->schedule;
    }

    public function getId()
    {
        return $this->id;
    }

    public function insertProvider()
    {
        /*$connObj = new Connection();
        $conn = $connObj->con();
        $sql = "INSERT INTO "
            . "user (`user_name`,`user_password`,`user_rol`) "
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

        //Message arrow array with the status and the message
        return $message;*/
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
                array_push($content,$providerRow);
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
