<?php

final class LogoutController
{
    public function defaultAction() {
        Session::destroy();
        header('Location: /home');
        exit;
    }
}