<?php

class AdminController
{
    public function defaultAction() {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            return;
        }
        View::show("/admin/admin-form");
    }

    public function deleteAction(Array $A_parametres = null, Array $A_postParams = null){
        if(Users::checkIfExistsById($A_postParams["id"])){
            Users::deleteByID($A_postParams["id"]);
        }
        header("Location: /admin");
    }

    public function addAction(Array $A_parametres = null, Array $A_postParams = null){
        var_dump($A_postParams);
        if(Users::checkIfExistsById($A_postParams["id"])){
            Admin::create($A_postParams);
        }
        header("Location: /admin");
    }
}