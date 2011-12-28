<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_CondicionesVer extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $id_condiciones = intval($argv[0]);

        $condicion = Db::query(
            "SELECT condiciones.id_condiciones
                  , condiciones.nombre AS condicion
               FROM condiciones
              WHERE condiciones.id_condiciones = '$id_condiciones'"
        );

        $this->set($condicion[0])
             ->end()
             ->title( array('Panel de Control', 'Condiciones', $condicion[0]['condicion']) );
    }
}