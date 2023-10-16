<?php
namespace CRUD;
use CRUD\Connection;
use CRUD\UserModel;
use Exception;

class UserController
{
    private UserModel $User;

    public function __construct($user)
    {
        $this->User = $user;
    }

    public function getUser()
    {
        return $this->User;
    }

    public function findAll()
    {
        try
        {
            return Connection::Connection()->query("select id, username, role, created_at, updated_at from users;")->fetchAll();
        }
        catch(Exception $e)
        {
            return array("error" => $e->getMessage());
        }
    }

    public function find($id)
    {
        try
        {
            return Connection::Connection()->query("select id, username, role, created_at, updated_at from users where id = {$id};")->fetchAll();
        }
        catch(Exception $e)
        {
            return array("error" => $e->getMessage());
        }
    }

    public function findByUsername($username)
    {
        try
        {
            return Connection::Connection()->query("select id, username, role, created_at, updated_at from users where username = '{$username}';")->fetchAll();
        }
        catch(Exception $e)
        {
            return array("error" => $e->getMessage());
        }
    }

    public function save($username, $password, $role)
    {
        try
        {
            $result = Connection::Connection()->query("insert into users values (null, '$username', sha2('$password', 512), '$role', default, default)");
            return $result;
        }
        catch(Exception $e)
        {
            return array("error" => $e->getMessage());
        }
    }

    public function put($id, $username, $role)
    {
        try
        {
            $result = Connection::Connection()->query("update users as u set u.username = \"$username\", u.role = \"$role\" where u.id = $id;");
            return $result;
        }
        catch(Exception $e)
        {
            return array("error" => $e->getMessage());
        }
    }

    public function putPassword($id, $password)
    {
        try
        {
            $result = Connection::Connection()->query("update users as u set u.password = sha2(\"$password\", 512) where u.id = $id;");
            return $result;
        }
        catch(Exception $e)
        {
            return array("error" => $e->getMessage());
        }
    }

    public function remove($id)
    {
        try
        {
            $result = Connection::Connection()->query("delete from users where id = $id;");
            return $result;
        }
        catch(Exception $e)
        {
            return array("error" => $e->getMessage());
        }
    }
}

?>