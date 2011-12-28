<?php

include_once "$root/bin/Base.php";

class Error404 extends Base
{
    public $type = 'text/html';

    public function __construct()
    {
        parent::__construct('Error 404');
    }
}