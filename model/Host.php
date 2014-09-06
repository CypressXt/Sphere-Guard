<?php

/*
 * 
 * Clément Hampaï
 * 
 */

class Host {

    private $pk_host;
    private $name;
    private $ip;

    //Constructor
    //-----------
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    //Getters
    //-------

    public function getPk_host() {
        return $this->pk_host;
    }

    public function getName() {
        return $this->name;
    }

    public function getIp() {
        return $this->ip;
    }

    // Setters
    //--------

    public function setPk_host($pk_host) {
        $this->pk_host = $pk_host;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    //Hydrate function
    //----------------

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

}
