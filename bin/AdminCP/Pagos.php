<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Pagos extends AdminCP_Base
{
    public $type = 'text/html';
    private $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct('Pagos');

        $this->done = ( $argv[0] == 'done' );

        if ( $this->done )
            $this->block('validation')->end()
                 ->block('validation.done')->end();

        $pagos = Db::query(
            "SELECT pagos.id_pagos
                  , pagos.nombre
                  , pagos.digitos
               FROM pagos"
        );

        $pos = 1;

        foreach ( $pagos as $pago )
        {
            $pago['class'] = ( $pos % 2 == 0 ) ? 'even' : 'odd';
            $pago['pos']   = $pos++;

            $this->block('each')
                 ->set($pago)
                 ->end();
        }
    }
}