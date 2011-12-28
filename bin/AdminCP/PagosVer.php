<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_PagosVer extends AdminCP_Base
{
    public $type = 'text/html';

    private $id = 0;
    
    public function __construct( $argv = array() )
    {
        parent::__construct('Pagos');
        
        $this->id = intval($argv[0]);

        $pago = Db::query(
            "SELECT pagos.id_pagos
                  , pagos.nombre
                  , pagos.digitos
                  , pagos_meta.nombre AS metaName
                  , pagos_meta.valor AS metaValue
               FROM pagos
          LEFT JOIN pagos_meta
                 ON pagos_meta.id_pagos = pagos.id_pagos
              WHERE pagos.id_pagos = '$this->id'
           ORDER BY pagos_meta.id_pagos_meta"
        );
        
        $this->set($pago[0]);
        
        foreach ( $pago as $val )
            $this->block('meta')->set($val)->end();
    }
}