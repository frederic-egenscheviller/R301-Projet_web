<?php

/**
 * LogoutController class
 *
 * This class controls the logout process.
 */
final class LogoutController
{
    /**
     * defaultAction function
     *
     * Destroys the session and redirects the user to the home page.
     *
     * @return void
     */
    public function defaultAction() : void{
        Session::destroy();
        header('Location: /home');
        exit;
    }
}