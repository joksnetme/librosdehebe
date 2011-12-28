<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_IdiomasVer extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Idiomas');
        
        $id_idiomas = intval($argv[0]);
        
        $idioma = Db::query(
            "SELECT idiomas.id_idiomas
                  , idiomas.nombre AS idioma
                  , idiomas.abbr
               FROM idiomas
              WHERE idiomas.id_idiomas = '$id_idiomas'"
        );
        
        $this->set($idioma[0]);
    }
}