<?php

/*
 * CypressXt
 */

class User {

    private $pk_api;
    private $name;
    private $password;
    private $mail;
    private $key;
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

    public function getKey() {
        return $this->key;
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

    public function setKey($key) {
        $this->key = $key;
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
