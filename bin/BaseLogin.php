<?php

include_once "$root/bin/Base.php";

class BaseLogin extends Base
{
    public function __construct( $title = null )
    {
        parent::__construct($title, null, '/');

        if ( !( $this->user->login ) )
            Web::redirect('/login/');
    }
}