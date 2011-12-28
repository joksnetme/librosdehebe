<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_LibreriasVer extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];
        $this->done = ( $argv[1] == 'done' );

        if ( $this->done )
            $this->block('validation')->end()
                 ->block('validation.done')->end();

        if ( $this->id && is_numeric($this->id) )
            $this->view($this->id);
        else
            Web::redirect('/admincp/librerias/error/');
    }

    public function view( $id )
    {
        $result = Db::query(
            "SELECT librerias.id_librerias
                  , librerias.nombre
               FROM librerias
              WHERE librerias.id_librerias = '$id'"
        );

        $libreria = $result[0];

        $this->title(
            array('Panel de Control', 'Librerias', $libreria['nombre'])
        );

        $this->set($libreria)
             ->end();
    }
}