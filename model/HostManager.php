<?php

/*
 * CypressXt
 */

class HostManager {

    private $db;

    //Constructor
    //-----------

    public function __construct($db) {
        $this->setDb($db);
    }

    public function setDb(PDO $db) {
        $this->db = $db;
    }

    public function addHost(Host $host) {
        $isOk = false;
        try {
            $q = $this->db->prepare('INSERT INTO `host`(`name`, `ip`) VALUES (:name,:ip)');
            $q->bindValue(':name', $host->getName(), PDO::PARAM_STR);
            $q->bindValue(':ip', $host->getIp(), PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $this->db->commit();
            $isOk = true;
        } catch (PDOException $e) {
            $this->db->rollback();
        }
        return $isOk;
    }

    public function updateHost(Host $host) {
        $isOk = false;
        try {
            $q = $this->db->prepare('UPDATE `host` SET `name`=:name,`ip`=:ip WHERE `pk_host` =:pk_host');
            $q->bindValue(':name', $host->getName(), PDO::PARAM_STR);
            $q->bindValue(':ip', $host->getIp(), PDO::PARAM_STR);
            $q->bindValue(':pk_host', $host->getPk_host(), PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $this->db->commit();
            $isOk = true;
        } catch (PDOException $e) {
            $this->db->rollback();
        }
        return $isOk;
    }

    public function getAllHosts() {
        $hostArray = array();
        try {
            $q = $this->db->prepare('SELECT * FROM `host`');
            $this->db->beginTransaction();
            $q->execute();
            while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
                $hostArray[] = new Host($data);
            }
            $this->db->commit();
        } catch (PDOException $exc) {
            $this->db->rollback();
        }
        return $hostArray;
    }

    public function getHostById($pk_host) {
        $host = null;
        try {
            $q = $this->db->prepare('SELECT * FROM `host` WHERE `pk_host` = :pk_host');
            $q->bindValue(':pk_host', $pk_host, PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $host = new Host($data);
            }
            $this->db->commit();
        } catch (PDOException $exc) {
            $this->db->rollback();
        }
        return $host;
    }

    public function getCpuOverview() {
        $allInfo = array();
        $q = $this->db->prepare('(SELECT * FROM (SELECT * FROM `performance` WHERE performance.fk_type = 2 order by performance.date desc) as info group by `fk_host` ) order by `value` desc');
        $q->execute();

        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $allInfo[] = $data;
        }
        return $allInfo;
    }

    public function getTmpOverview() {
        $allInfo = array();
        $q = $this->db->prepare('(SELECT * FROM (SELECT * FROM `performance` WHERE performance.fk_type = 4 order by performance.date desc) as info group by `fk_host` ) order by `value` desc');
        $q->execute();

        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $allInfo[] = $data;
        }
        return $allInfo;
    }

    public function removeHost($pk_host) {
        $isOk = false;
        try {
            $q = $this->db->prepare('DELETE FROM `performance` WHERE `fk_host` =:pk_host');
            $q->bindValue(':pk_host', $pk_host, PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $this->db->commit();
            $q = $this->db->prepare('DELETE FROM `host` WHERE `pk_host` =:pk_host');
            $q->bindValue(':pk_host', $pk_host, PDO::PARAM_STR);
            $this->db->beginTransaction();
            $q->execute();
            $this->db->commit();
            $isOk = true;
        } catch (PDOException $e) {
            $this->db->rollback();
        }
        return $isOk;
    }

}
