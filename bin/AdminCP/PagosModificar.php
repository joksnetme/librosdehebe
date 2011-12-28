<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_PagosModificar extends AdminCP_Base
{
    public $type = 'text/html';

    private $meta = array();
    private $id   = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct('Pagos');
        
        $this->id = intval($argv[0]);
        
        $pago = Db::query(
            "SELECT pagos.id_pagos
                  , pagos.nombre
                  , pagos.digitos
                  , pagos_meta.id_pagos_meta
                  , pagos_meta.nombre AS metaName
                  , pagos_meta.valor AS metaValue
               FROM pagos
          LEFT JOIN pagos_meta
                 ON pagos_meta.id_pagos = pagos.id_pagos
              WHERE pagos.id_pagos = '$this->id'
           ORDER BY pagos_meta.id_pagos_meta"
        );

        $this->set($pago[0]);
        
        if ( !Web::isPost() || $this->id == $_POST['id_pagos']  )
        {
            foreach ( $pago as $val ){
                $this->block('meta')->set(array(
                    'name'  => $val['metaName'],
                    'value' => $val['metaValue'],
                    'i'     => $val['id_pagos_meta']
                ))->end();
            }
        }
    }
    
    public function __onSubmit()
    {
        $delete = false;
        
        if ( isset($_POST['delMeta']) )
            $delete = array_shift(array_keys($_POST['delMeta']));
    
        if ( is_array($_POST['metaName']) && is_array($_POST['metaValue']) )
        {
            foreach ( $_POST['metaName'] as $id_pagos_meta => $metaName ){
                
                if ( !$delete || $delete != $id_pagos_meta )
                    $this->meta[$id_pagos_meta] = array($metaName, $_POST['metaValue'][$id_pagos_meta]);
            }
        }
        
        if ( isset($_POST['addMeta']) )
            $this->meta['new' . rand(1, 784578)] = array('', '');
        
        
        if ( isset($_POST['save']) )
        {
            $this->validation(array(
                'nombre'  => 'required',
                'digitos' => 'required'
            ));
        
            if ( $this->isValid() )
            {
                Db::update('pagos', array(
                    'nombre'  => $_POST['nombre'],
                    'digitos' => $_POST['digitos']
                ), "id_pagos = '$this->id'");
                
                if ( is_array($_POST['metaName']) && is_array($_POST['metaValue']) )
                {
                    $idsPagosMeta = array(0);

                    foreach ( $_POST['metaName'] as $id_pagos_meta => $metaName )
                    {
                        if ( substr($id_pagos_meta, 0, 3) == 'new' )
                        {
                            $idsPagosMeta[] = Db::insert('pagos_meta', array(
                                'id_pagos' => $this->id,
                                'nombre'   => $metaName,
                                'valor'    => $_POST['metaValue'][$id_pagos_meta]
                            ));
                        }
                        else
                        {
                            Db::update('pagos_meta', array(
                                'nombre'   => $metaName,
                                'valor'    => $_POST['metaValue'][$id_pagos_meta]
                            ), "id_pagos_meta = '$id_pagos_meta'");
                            
                            $idsPagosMeta[] = $id_pagos_meta;
                        }
                    }

                    Db::query(
                        "DELETE FROM pagos_meta
                               WHERE pagos_meta.id_pagos = '$this->id'
                                 AND pagos_meta.id_pagos_meta NOT IN('" . implode("', '", $idsPagosMeta) . "')"
                    );
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