<?php

class RetrievepwdController
{
    public function defaultAction() {
        View::show("retrieve_pwd/form-change-pwd");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) {
        $A_retrieveTable =  Retrieve_Pwd::selectById($A_postParams["id"]);

        if ($A_retrieveTable["token"] != $A_postParams["token"]){
            echo "token inexistant";
            return;
        }

        if ($A_postParams["password"] != $A_postParams["password_confirmation"]){
            echo "mdps pas egaux";
            return;
        }

        unset($A_postParams["password_confirmation"]);
        Users::updateById($A_postParams,$A_postParams["id"]);

        Retrieve_Pwd::deleteByID($A_postParams["id"]);

        header("Location: /signin");
    }
}