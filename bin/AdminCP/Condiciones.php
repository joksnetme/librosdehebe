<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Condiciones extends AdminCP_Base
{
    public $type = 'text/html';

    protected $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct('Condiciones');

        $this->done = ( $argv[0] == 'done' );

        if ( $this->done )
            $this->block('validation')->end()
                 ->block('validation.done')->end();

        $condiciones = Db::query(
            "SELECT condiciones.id_condiciones
                  , condiciones.nombre
               FROM condiciones
           ORDER BY condiciones.nombre"
        );

        $pos = 1;

        foreach ( $condiciones as $condicion )
        {
            $condicion['class'] = ( $pos % 2 == 0 ) ? 'even' : 'odd';
            $condicion['pos']   = $pos++;

            $this->block('each')
                 ->set($condicion)
                 ->end();
        }
    }
}