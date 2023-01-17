<?php

final class SignupController
{
    public function defaultAction() {
        View::show("signup/form");
    }
}