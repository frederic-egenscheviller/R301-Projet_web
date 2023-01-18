<?php

final class SigninController
{
    public function defaultAction() {
        View::show("signin/form");
    }
}