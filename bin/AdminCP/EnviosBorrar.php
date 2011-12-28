<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_EnviosBorrar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct( array('Formas de Envio', 'Borrar') );

        if ( $idEnvios = intval($argv[0]) )
        {
            Db::query(
                "DELETE FROM envios WHERE id_envios = '$idEnvios' LIMIT 1"
            );
        }

        header('Location: /admincp/envios/done/');
    }
}