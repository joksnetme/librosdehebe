<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Libros extends AdminCP_Base
{
    public $type = 'text/html';

    protected $done = false;
    protected $error = false;

    public function __construct( $argv = array() )
    {
        parent::__construct('Libros');

        $this->done = ( $argv[0] == 'done' );
        $this->error = ( $argv[0] == 'error' );

        if ( $this->error )
        {
            $this->block('validation')->end()
                 ->block('validation.error')->end();
        }

        if ( $this->isModulo(MODULOS_LIBROS_COLECCIONES) )
            $this->block('ifColeccion');
    }

    public function __onSubmit()
    {
        $query = $_POST['query'];
        $query = urlencode($query);

        Web::redirect("/admincp/libros/$query/");
    }
}