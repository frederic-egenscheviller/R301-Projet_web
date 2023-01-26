<?php

class AdminController
{
    public function defaultAction() {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }
        View::show("/admin/add-admin-form");
        View::show("/admin/delete-user-form");
        View::show("/admin/delete-appreciation", Appreciation::selectAll());
    }

    public function deleteAction(Array $A_parametres = null, Array $A_postParams = null){
        Users::deleteByID($A_postParams["id"]);
        header("Location: /admin");
    }

    public function addAction(Array $A_parametres = null, Array $A_postParams = null){
        Admin::create($A_postParams);
        header("Location: /admin");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null){
        Appreciation::deleteByID($A_parametres[0]);
        header("Location: /admin");
    }
}