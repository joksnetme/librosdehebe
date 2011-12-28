<?php

include_once "$root/bin/Base.php";

class UserCP_Base extends Base
{
    public function __construct( $title = null )
    {
        if ( is_null($title) )
            $title = 'Mi Cuenta';
        else
        {
            if ( is_array($title) )
                $title = implode(' &raquo; ', $title);

            $title = "Mi Cuenta &raquo; $title";
        }

        parent::__construct($title, null, '/UserCP/');

        if ( !( $this->user->login ) )
            Web::redirect('/login/');

        $this->nav('Mi Cuenta');
    }
}