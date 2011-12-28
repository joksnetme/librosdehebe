<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Librerias extends AdminCP_Base
{
    public $type = 'text/html';

    protected $done = false;
    protected $error = false;

    public function __construct( $argv = array() )
    {
        parent::__construct('Librerias');

        $this->done = ( $argv[0] == 'done' );
        $this->error = ( $argv[0] == 'error' );

        if ( $this->done )
            $this->block('validation')->end()
                 ->block('validation.done')->end();

        if ( $this->error )
            $this->block('validation')->end()
                 ->block('validation.error')->end();

        $result = Db::query(
            "SELECT librerias.id_librerias
                  , librerias.nombre
               FROM librerias
           ORDER BY librerias.nombre"
        );

        $pos = 1;

        foreach ( $result as $row )
        {
            $row['class'] = ( $pos % 2 == 0 ) ? 'even' : 'odd';
            $row['pos']   = $pos;

            $this->block('each')
                 ->set($row)
                 ->end();

            $pos++;
        }
    }
}