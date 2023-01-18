<?php

final class PeculiaritiesController
{
    public function defaultAction($A_postParams) {
        View::show("peculiarities/show", Peculiarities::selectById($A_postParams));
    }

    public function createAction($A_postParams) {
        View::show("status", Peculiarities::create($A_postParams));
    }

    public function editAction($A_postParams) {
        $this -> formAction();
        View::show("peculiarities/show", Peculiarities::selectById($A_postParams['id']));
    }

    public function deleteAction($A_postParams) {
        View::show("status", Peculiarities::deleteById($A_postParams['id']));
    }

    public function formAction() {
        View::show("peculiarities/form");
    }

    public function updateAction($A_postParams) {
        View::show("peculiarities/form", Peculiarities::update($A_postParams));
    }
}