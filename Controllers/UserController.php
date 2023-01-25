<?php

final class UserController
{
    public function defaultAction() {
        View::show("errors/error404");
    }

    public function logoutAction() {
        Session::destroy();
        header('Location: /home');
        exit;
    }
}