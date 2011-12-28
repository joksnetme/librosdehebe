<?php

include_once "$root/bin/Base.php";

class ContactoGracias extends Base
{
    public $type = 'text/html';

    public function __construct()
    {
        parent::__construct('Contacto');

        $this->nav('Contacto');
    }
}