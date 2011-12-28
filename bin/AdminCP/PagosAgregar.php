<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_PagosAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    private $meta = array();

    public function __construct( $argv = array() )
    {
        parent::__construct('Pagos');
    }
    
    public function __onSubmit()
    {
        if ( is_array($_POST['metaName']) && is_array($_POST['metaValue']) )
        {
            foreach ( $_POST['metaName'] as $i => $metaName )
                $this->meta[$i] = array($metaName, $_POST['metaValue'][$i]);
        }
        
        if ( isset($_POST['addMeta']) )
            $this->meta[] = array('', '');
        
        if ( isset($_POST['save']) )
        {
            $this->validation(array(
                'nombre'  => 'required',
                'digitos' => 'required'
            ));
        
            if ( $this->isValid() )
            {
                $idPagos = Db::insert('pagos', array(
                    'nombre'  => $_POST['nombre'],
                    'digitos' => $_POST['digitos']
                ));
                
                if ( is_array($_POST['metaName']) && is_array($_POST['metaValue']) )
                {
                    foreach ( $_POST['metaName'] as $i => $metaName )
                    {
                        Db::insert('pagos_meta', array(
                            'id_pagos' => $idPagos,
                            'nombre'   => $metaName,
                            'valor'    => $_POST['metaValue'][$i]
                        ));
                    }
                }
                
                Web::redirect('/admincp/pagos/done/');
            }
        }
        
        $this->set($_POST);
    }
    
    public function __toString()
    {
        foreach ( $this->meta as $i => $meta )
            $this->block('meta')->set(array(
                'i'     => $i,
                'name'  => $meta[0],
                'value' => $meta[1]
            ));

        parent::__toString();
    }
}