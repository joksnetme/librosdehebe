<?php

include_once "$root/bin/BaseLogin.php";

class UsuariosDeseosBorrar extends BaseLogin
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $idUsuarios = intval($argv[0]);
        $idDeseos   = intval($argv[1]);

        if ( $this->user->id == $idUsuarios || $this->user->admin )
            Db::query("DELETE FROM deseos WHERE id_deseos = '$idDeseos' AND id_usuarios = '$idUsuarios'");

        Web::redirect("/usuarios/$idUsuarios/deseos/");
    }
}