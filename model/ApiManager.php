<?php

class ApiManager {

    private $db;

    //Constructor
    //-----------

    public function __construct($db) {
        $this->setDb($db);
    }

    //Setter
    //------

    public function setDb(PDO $db) {
        $this->db = $db;
    }

    public function checkLogin($userName, $password) {
        $q = $this->db->prepare('SELECT * FROM `api` WHERE `name` = :userName and `password` = :password');
        $q->bindValue(':userName', $userName, PDO::PARAM_STR);
        $q->bindValue(':password', $password, PDO::PARAM_STR);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $data;
        } else {
            return null;
        }
    }

}
