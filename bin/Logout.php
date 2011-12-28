<?php

class Logout
{
    public function __construct()
    {
        // parent::__construct();

        Cookies::del('LDH_UID');
        Web::redirect('/login/');
    }
}