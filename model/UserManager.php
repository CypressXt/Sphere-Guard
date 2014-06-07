<?php

/*
 * CypressXt
 */

class UserManager {

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
            return new User($data);
        } else {
            return null;
        }
    }

    public function updateApi(User $user) {
        $isOk = false;
        try {
            $q = $this->db->prepare('UPDATE `api` SET `name` = :name, `password` = :password, `mail` = :mail WHERE `pk_api` = :pkApi');
            $q->bindValue(':name', $user->getName(), PDO::PARAM_STR);
            $q->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
            $q->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
            $q->bindValue(':pkApi', $user->getPk_api(), PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $this->db->commit();
            $isOk = true;
        } catch (PDOException $e) {
            $this->db->rollback();
        }
        return $isOk;
    }

    public function getAllApi() {
        $apiArray = array();
        try {
            $q = $this->db->prepare('SELECT * FROM `api`');
            $this->db->beginTransaction();
            $q->execute();
            while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
                $apiArray[] = new User($data);
            }
            $this->db->commit();
        } catch (PDOException $exc) {
            $this->db->rollback();
        }
        return $apiArray;
    }

    public function refreshKey($userId) {
        $newKey = "";
        try {
            $newKey = sha1(rand());
            $q = $this->db->prepare('UPDATE `api` SET `key` = :key WHERE `pk_api` = :pkApi');
            $q->bindValue(':key', $newKey, PDO::PARAM_STR);
            $q->bindValue(':pkApi', $userId, PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollback();
        }
        return $newKey;
    }

    public function removeApiUser($pk_api) {
        $isOk = false;
        try {
            $q = $this->db->prepare('DELETE FROM `api` WHERE `pk_api` = :pkApi');
            $q->bindValue(':pkApi', $pk_api, PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $this->db->commit();
            $isOk = true;
        } catch (PDOException $e) {
            $this->db->rollback();
        }
        return $isOk;
    }

    public function isMailTakenByOther(User $user, $newMail) {
        $q = $this->db->prepare('SELECT * FROM `api` WHERE mail like :mail');
        $q->bindValue(':mail', $newMail, PDO::PARAM_STR);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $mailProprietary = $data;
            if ($mailProprietary['pk_api'] != $user->getPk_api()) {
                return true;
            }
        }
        return false;
    }

}
