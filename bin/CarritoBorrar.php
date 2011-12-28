<?php

include_once "$root/bin/Base.php";

class CarritoBorrar extends Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Carrito');

        $idCarrito = intval( $argv[0] );
        $and       = $this->user->login
                   ? "( carrito.id_usuarios = '{$this->user->id}' OR carrito.ip = '" . Web::getIp() . "' )"
                   : "carrito.ip = '" . Web::getIp() . "'";

        $delete = Db::query(
            "DELETE FROM carrito
                   WHERE carrito.id_carrito = '$idCarrito'
                     AND $and
                   LIMIT 1"
        );

        if ( $delete == 1 )
            header("Location: /carrito/done/");
    }
    
}