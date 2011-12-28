<?php

include_once "$root/bin/UserCP/Base.php";

class UserCP_Main extends UserCP_Base
{
    public $type = 'text/html';

    public function __construct()
    {
        parent::__construct();
    }

    public function __toString()
    {
        $this->set('id_usuarios', $this->user->id)
             ->set('nombre', $this->user->data['nombre'])
             ->set('ultimo', date('d/m/Y H:i', $this->user->data['ultimo']));

        return parent::__toString();
    }
}