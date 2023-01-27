<?php

/**
 * Class AdminController
 *
 * The AdminController is responsible for managing admin related actions such as adding, deleting and updating.
 *
 * @package App\Controllers
 */
class AdminController
{

    /**
     * Default action for AdminController.
     *
     * Checks if the user is an admin and if so, show the respective forms.
     *
     * @return void
     */
    public function defaultAction():void {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }
        View::show("/admin/add-admin-form");
        View::show("/admin/delete-user-form");
        View::show("/admin/delete-appreciation", Appreciation::selectAll());
    }

    /**
     * Delete action for AdminController.
     *
     * Deletes the user by his ID and checks if the user is an admin and remove him from the admin table
     *
     * @param array $A_parametres The parameters sent.
     * @param array $A_postParams The POST parameters.
     *
     * @return void
     */
    public function deleteAction(Array $A_parametres = null, Array $A_postParams = null):void{
        if (Users::checkIfExistsById($A_postParams["id"])) {
            UploadPicture::deletePicture(Users::selectById($A_postParams["id"])["picture"]);
            Appreciation::deleteAllByUserId($A_postParams["id"]);
            Recipe::deleteAllByUserId($A_postParams["id"]);
        }
        if (Admin::checkIfExistsById($A_postParams["id"])){
            Admin::deleteByID($A_postParams["id"]);
        }
        Users::deleteByID($A_postParams["id"]);
        header("Location: /admin");
    }

    /**
     * Add action for AdminController.
     *
     * Checks if the user exists by his ID, if not, creates the admin
     *
     * @param array $A_parametres The parameters sent.
     * @param array $A_postParams The POST parameters.
     *
     * @return void
     */
    public function addAction(Array $A_parametres = null, Array $A_postParams = null):void{
        if(Users::checkIfExistsById($A_postParams["id"])){
            Admin::create($A_postParams);
        }
        header("Location: /admin");
    }

    /**
     * Update action for AdminController.
     *
     * Deletes the appreciation by its ID and redirects to the admin page.
     *
     * @param array $A_parametres The parameters sent.
     * @param array $A_postParams The POST parameters.
     *
     * @return void
     */
    public function deleteappreciationAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Appreciation::deleteByID($A_parametres[0]);
        header("Location: /admin");
    }
}