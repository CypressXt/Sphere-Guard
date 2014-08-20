<?php

/*
 * CypressXt
 */

class User {

    private $pk_api;
    private $name;
    private $password;
    private $mail;
    private $apikey;
    private $nbCall;
    private $admin;

    //Constructor
    //-----------
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    //Getters
    //-------

    public function getPk_api() {
        return $this->pk_api;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getApikey() {
        return $this->apikey;
    }

    public function getNbCall() {
        return $this->nbCall;
    }

    public function getAdmin() {
        return $this->admin;
    }

    // Setters
    //--------


    public function setPk_api($pk_api) {
        $this->pk_api = $pk_api;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setApikey($apiKey) {
        $this->apikey = $apiKey;
    }

    public function setNbCall($nbCall) {
        $this->nbCall = $nbCall;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
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
