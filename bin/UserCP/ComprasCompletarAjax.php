<?php

include_once "$root/bin/UserCP/Base.php";

class UserCP_ComprasCompletarAjax extends UserCP_Base
{
    public $type = 'text/html';

    private $idCompras = 0;
    
    public function __construct( $argv = array() )
    {
        parent::__construct();
        
        $this->idCompras = intval($argv[0]);
        
        if ( isset($argv[1]) && $argv[1] == 'comprobante' )
        {
             $compra = Db::query(
                "SELECT compras.comprobante
                   FROM compras
                  WHERE compras.id_compras = '{$this->idCompras}'
                    AND compras.id_usuarios = '{$this->user->id}'"
             );
             
             print $compra[0]['comprobante'];
        }

    }

    public function __onSubmit()
    {
        $pagos = Db::query(
            "SELECT compras.id_compras
                  , pagos.digitos
               FROM compras
         INNER JOIN pagos
                 ON pagos.id_pagos = compras.id_pagos
              WHERE compras.id_compras = '$this->idCompras'
                AND compras.id_usuarios = '{$this->user->id}'"
        );
        
        $pagos       = $pagos[0];
        $comprobante = $_POST['comprobante'];
        
        if ( strlen($comprobante) != $pagos['digitos'] )
            print $pagos['digitos'];

        else
        {
            Db::update('compras', array(
                'comprobante' => $comprobante,
                'completado'  => 1
            )
            , "id_compras = '{$pagos['id_compras']}'");
            
            print 'ok';
        }
    }
    
    public function __toString(){}
}