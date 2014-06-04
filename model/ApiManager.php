<?php

/*
 * CypressXt
 */

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

    public function updateApi($user) {
        try {
            $q = $this->db->prepare('UPDATE `api` SET `name` = :name, `password` = :password, `mail` = :mail WHERE `pk_api` = :pkApi');
            $q->bindValue(':name', $user['name'], PDO::PARAM_STR);
            $q->bindValue(':password', $user['password'], PDO::PARAM_STR);
            $q->bindValue(':mail', $user['mail'], PDO::PARAM_STR);
            $q->bindValue(':pkApi', $user['pk_api'], PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollback();
        }
    }

    public function isMailTakenByOther($user, $newMail) {
        $q = $this->db->prepare('SELECT * FROM `api` WHERE mail like :mail');
        $q->bindValue(':mail', $newMail, PDO::PARAM_STR);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $mailProprietary = $data;
            if ($mailProprietary['pk_api'] != $user['pk_api']) {
                return true;
            }
        } else {
            return false;
        }
    }

}
