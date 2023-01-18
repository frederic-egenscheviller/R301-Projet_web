<?php

class ControllerException extends Exception {
    public function __construct($message = null) {
        View::show("errors/error404");
    }
}