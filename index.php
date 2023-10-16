<?php
    namespace CRUD;
    require("./controller/Connection.php");
    require("./controller/UserController.php");
    require("./model/UserModel.php");

    $UserController = new UserController(new UserModel(0, "", "", "u"));

    foreach($UserController->findAll() as $row)
    {
        $user = new UserModel($row[0], $row["username"], $row["password"], $row["role"]);
        echo json_encode($user);
    }

    foreach($UserController->find(1) as $row)
    {
        $user = new UserModel($row[0], $row[1], $row[2], $row[3]);
        echo json_encode($user);
    }

    ?>