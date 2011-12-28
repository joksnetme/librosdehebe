<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Main extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();
        
    }

    public function __toString()
    {
        if ( $this->isModulo(MODULOS_BUSCAR_SINONIMOS) )
            $this->block('buscar_sinonimos')->end();

        if ( $this->isModulo(MODULOS_LIBROS_COLECCIONES) )
            $this->block('libros_colecciones')->end();

        parent::__toString();
    }
}