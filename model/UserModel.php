<?php
namespace CRUD;
class UserModel
{
    private $id, $username, $password, $role;
    private $User;

    public function __construct($id, $username, $password, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getRole() { return $this->role; }
    public function getUser() { return $this; }

    public function setId($id) { return $this->id = $id; }
    public function setUsername($username) { return $this->username = $username; }
    public function setPassword($password) { return $this->password = $password; }
    public function setRole($role) { return $this->role = $role; }
    public function setUser($User) { return $this->User = $User; }
}