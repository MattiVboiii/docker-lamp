<?php
class User
{
    // Properties van dit object
    public $id;
    public $username;
    public $email;
    private $password;
    public $avatar;

    public function __construct(String $username, String $email, String $avatar = 'default.png')
    {
        $this->username = $username;
        $this->email = $email;
        $this->avatar = $avatar;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($i)
    {
        $this->id = $i;
    }

    public function getUsername()
    {
        return $this->username . $this->getServerMacAddress();
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($pass)
    {
        $this->password = $pass;
    }

    private function getPassword()
    {
        return $this->password;
    }

    // Functies van dit object, maar we noemen deze methods.
    public function checkPassword($pass)
    {
        return $pass === $this->getPassword();
    }

    public function printName()
    {
        return ucwords($this->username);
    }

    public function logout() {}

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function delete() {}


    private function getServerMacAddress()
    {
        return $_SERVER['SERVER_ADDR'];
    }
}
