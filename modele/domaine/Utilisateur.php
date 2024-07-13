<?php

class Utilisateur
{
    private $id;
    private $username;
    private $password;
    private $role;

    public function __construct($id, $username, $password, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
}
