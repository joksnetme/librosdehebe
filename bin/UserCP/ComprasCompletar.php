<?php

include_once "$root/bin/UserCP/Base.php";

class UserCP_ComprasCompletar extends UserCP_Base
{
    public $type = 'text/html';

    private $idCompras = 0;
    
    public function __construct( $argv = array() )
    {
        parent::__construct();
        
        $this->idCompras = intval($argv[0]);

        $compra = Db::query(
           "SELECT compras.comprobante
              FROM compras
             WHERE compras.id_compras = '{$this->idCompras}'
               AND compras.id_usuarios = '{$this->user->id}'"
        );

        $this->set(array(
            'idCompras'   => $this->idCompras,
            'comprobante' => $compra[0]['comprobante']
        ));
    }

    public function __onSubmit()
    {
        $pagos = Db::query(
            "SELECT compras.id_compras
                  , pagos.digitos
               FROM compras
         INNER JOIN pagos
                 ON pagos.id_pagos = compras.id_compras
              WHERE compras.id_compras = '$this->idCompras'
                AND compras.id_usuarios = '{$this->user->id}'"
        );
        
        $pagos = $pagos[0];
        $this->set($pagos);
        
        $this->validation(array(
            'comprobante' => array('required' => true, 'rangeLength' => array($pagos['digitos'], $pagos['digitos']))
        ));
        
        if ( $this->isValid() )
        {
            $comprobante = $_POST['comprobante'];

            if ( strlen($comprobante) != $pagos['digitos'] )
                print $pagos['digitos'];

            else {
                Db::update('compras', array(
                    'comprobante' => $comprobante,
                    'completado'  => 1
                )
                , "id_compras = '{$pagos['id_compras']}'");

            }
        }
        
        $this->set($_POST);
    }
}