<?php

namespace CRUD;

require("../controller/Connection.php");
require("../controller/UserController.php");
require("../model/UserModel.php");

global $_PUT;
$_PUT = array();
if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
    parse_str(file_get_contents('php://input'), $_PUT);
}

global $_DELETE;
$_DELETE = array();
if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
    parse_str(file_get_contents('php://input'), $_DELETE);
}

foreach ($_REQUEST as $r) {
    htmlspecialchars($r);
}
foreach ($_PUT as $r) {
    htmlspecialchars($r);
}
foreach ($_DELETE as $r) {
    htmlspecialchars($r);
}

if (isset($_SERVER["REQUEST_METHOD"]))
{
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if (!isset($_REQUEST["id"]) && !isset($_REQUEST["username"])) {
            $UserController = new UserController(new UserModel(0, "", "", "u"));
            $result = array();
            foreach ($UserController->findAll() as $row)
            {
                $result [] = array_unique($row);
            }
            echo json_encode($result);
        } else if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $UserController = new UserController(new UserModel(0, "", "", "u"));
            $result = array();
            foreach ($UserController->find($id) as $row)
            {
                $result [] = array_unique($row);
            }
            echo json_encode($result);
        } else if (isset($_REQUEST["username"])) {
            $username = $_REQUEST["username"];
            $UserController = new UserController(new UserModel(0, "", "", "u"));
            $result = array();
            foreach ($UserController->findByUsername($username) as $row)
            {
                $result [] = array_unique($row);
            }
            echo json_encode($result);
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_REQUEST["username"]) && isset($_REQUEST["password"]))
        {
            $UserController = new UserController(new UserModel(0, "", "", ""));
            $role = "u";
            
            if(isset($_REQUEST["role"]))
            {
                $role = $_REQUEST["role"];
            }

            $result = $UserController->save($_REQUEST["username"], $_REQUEST["password"], $role);

            echo json_encode($result);
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "PUT" && isset($_REQUEST["id"]) && isset($_REQUEST["username"]))
    {
            $UserController = new UserController(new UserModel(0, "", "", "u"));
            $role = "u";
            
            if(isset($_REQUEST["role"]))
            {
                $role = $_REQUEST["role"];
            }

            $result = $UserController->put($_REQUEST["id"], $_REQUEST["username"], $_REQUEST["role"]);
            echo json_encode($result);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "PUT" && isset($_PUT["id"]) && isset($_PUT["password"]))
    {
            $UserController = new UserController(new UserModel(0, "", "", "u"));

            $result = $UserController->putPassword($_PUT["id"], $_PUT["password"]);
            echo json_encode($result);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_DELETE["id"]))
    {
            $UserController = new UserController(new UserModel(0, "", "", "u"));

            $result = $UserController->remove($_DELETE["id"]);
            echo json_encode($result);
    }
}
