<?php
/**
 * Class TermsofusesController
 *
 * This class is used to define the defaultAction method to show the terms of uses view.
 */
final class TermsofusesController
{
    /**
     * Shows the terms of use
     *
     * @return void
     */
    public function defaultAction() : void{
        View::show("/signup/termsofuses");
    }
}