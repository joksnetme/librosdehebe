<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Paises extends AdminCP_Base
{
    public $type = 'text/html';

    private $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct('Paises');
        
        $this->done = ( $argv[0] == 'done' );

        if ( $this->done )
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        
        $paises = Db::query(
            "SELECT paises.id_paises
                  , paises.pais
                  , paises.abbr
                  , paises.codigo
               FROM paises
           ORDER BY paises.pais"
        );
        
        $pos = 1;
        
        foreach ( $paises as $pais ){
            $pais['class'] = ( $pos % 2 == 0 ) ? 'even' : 'odd';
            $pais['pos']   = $pos;
            $this->block('each')->set($pais)->end();
            $pos++;
        }

    }
}