<?php

include_once "$root/bin/Base.php";

class QuienesSomos extends Base
{
    public $type = 'text/html';

    public function __construct()
    {
        parent::__construct('Quienes Somos');

        $this->nav('Quienes Somos');
    }
}