<?php

namespace App\Controllers;

use App\Models\Api\Users;

class UserController
{
    public function get($id = null)
    {

        if ($id) {
            $user = new Users;
            $result = $user->select($id);
            return $result;
        } else {
            $user1 = new Users;
            $result1 = $user1->selectAll();
            return $result1;
        }
    }
    //Structed - Multiplataform
    public function post()
    {
        $user = new Users;
        $result = $user->insert($_POST);
        return $result;
    }
    //Structed - Form Url Encode 
    public function update()
    {
        parse_str(file_get_contents('php://input'), $_PATCH);
        $user = new Users;
        $result = $user->update($_PATCH);
        return $result;
    }

    public function delete()
    {
        echo "CHEGAMOS DELETE";
        parse_str(file_get_contents('php://input'), $_DELETE);
        $user = new Users;
        $result = $user->delete($_DELETE);
        return $result;
    }
}