<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_ComprasPendientes extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Compras');

        $where = array(
            'finalizado'  => 1,
            'rechazado'   => 0,
        );

        $dbCompras = Db::query(
            "SELECT compras.id_compras
               FROM compras
              WHERE compras.finalizado = 1
                AND compras.rechazado = 0"
        );

        $compras = array(
            'aprobacion' => array(),
            'envio'      => array()
        );
        
        foreach ( $dbCompras as $compra )
        {
            if ( $compra['aprobado'] == 0 )
                $compras['aprobacion'][] = $compra;
                
            if ( $compra['completado'] == 1 && $compra['aprobado'] == 1 && $compra['enviado'] == 1 )
                $compras['envio'][] = $compra;
        }
        
        print_r($compras);
        
    }
}