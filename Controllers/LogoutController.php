<?php

final class LogoutController
{
    public function defaultAction() : void{
        Session::destroy();
        header('Location: /home');
        exit;
    }
}