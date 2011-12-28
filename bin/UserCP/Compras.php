<?php

include_once "$root/bin/UserCP/Base.php";

class UserCP_Compras extends UserCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }
        
        /* Counter */
        
        $nums = array(
            'RealizadasNum'             => 0,
            'FinalizadasNum'            => 0,
            'PendientesNum'             => 0,
            'PendientesdeAprobacionNum' => 0,
            'RechazadasNum'             => 0
        );

        $estados = array(
            'RealizadasNum'             => array('1-1-0-1-0'),
            'FinalizadasNum'            => array('1-1-1-1-0'),
            'PendientesNum'             => array('1-0-0-1-0'),
            'PendientesdeAprobacionNum' => array('1-1-0-0-0', '1-0-0-0-0'),
            'RechazadasNum'             => array('1-1-0-0-1', '1-0-0-0-1')
        );

        $compras = Db::query(
            "SELECT * FROM compras WHERE compras.id_usuarios = '{$this->user->id}'"
        );

        foreach ( $compras as $compra ){

            foreach ( $estados as $estadoNombre => $estadoExp )
            {
                $compraEstado = sprintf('%s-%s-%s-%s-%s', $compra['finalizado'], $compra['completado'], $compra['enviado'], $compra['aprobado'], $compra['rechazado']);
                if ( in_array($compraEstado, $estadoExp ) )
                {
                    $nums[$estadoNombre]++;
                    break;
                }
            }
        }

        $this->set($nums);
        
        /* End Counter */
        
        $where = array(
            'finalizado' => 1
        );

        switch( $argv[0] )
        {
            case 'realizadas':
                $where['completado'] = 1;
                $where['aprobado']   = 1;
                $where['rechazado']  = 0;
                $where['enviado']    = 0;
            break;
            
            case 'finalizadas':
                $where['completado'] = 1;
                $where['aprobado']   = 1;
                $where['enviado']    = 1;
                $where['rechazado']  = 0;
            break;
            
            case 'pendientes':
                $where['completado'] = 0;
                $where['aprobado']   = 1;
                $where['rechazado']  = 0;
                $where['enviado']    = 0;
            break;
            
            case 'rechazadas':
                $where['rechazado']  = 1;
                $where['aprobado']   = 0;
                $where['enviado']    = 0;
            break;
        }
        
        if ( isset($argv[1]) )
        {
            $where['aprobado'] = 0;
            
            switch( $argv[1] )
            {
                case 'aprobacion':
                    unset($where['completado']);
                    $where['rechazado'] = 0;
                    $where['aprobado']  = 0;
                    $where['enviado']   = 0;
                break;
            }
        }

        $this->set("{$argv[0]}{$argv[1]}Selected", ' class="selected"');
        
        $sqlWhere = '';
        
        foreach ( $where as $field => $value )
            $sqlWhere .= " compras.$field = '$value' AND";
        
        $sqlWhere = substr($sqlWhere, 0, -3);
        
        $compras = Db::query( 
            "SELECT compras.id_compras
                  , compras.completado
                  , compras.fecha
               FROM compras
              WHERE$sqlWhere"
        );
        
        if ( $argv[0] == 'realizadas' || $argv[0] == 'pendientes' )
            $this->block('cambiarComprobante')->end();
            
        foreach ( $compras as $i => $compra )
        {
            $precio = getCompraPrecio($compra['id_compras'], $this->user->id, $this->isModulo(MODULOS_LIBROS_OFERTAR), $this->isModulo(MODULOS_LIBROS_CANTIDADES));
            $fecha  = date('d/m/Y H:i', $compra['fecha']);
            
            $this->block('compras')->set(array(
                'precio'     => $precio,
                'fecha'      => $fecha,
                'id_compras' => $compra['id_compras'],
                'class'      => ++$i % 2 == 0 ? 'even' : 'odd'
            ))->end();
            
            if ( $compra['completado'] == 0 )
                $this->block('compras.pendiente')->end();
            
            if ( $argv[0] == 'realizadas' )
                $this->block('compras.cambiarComprobante')->end();
            
            $libros = Db::query(
                "SELECT libros.id_libros 
                      , libros.titulo
                      , carrito.cantidad
                   FROM compras
             INNER JOIN compras_items
                     ON compras_items.id_compras = compras.id_compras
             INNER JOIN carrito
                     ON carrito.id_carrito = compras_items.id_carrito
             INNER JOIN libros
                     ON libros.id_libros = carrito.id_libros
                  WHERE compras.id_compras = '{$compra['id_compras']}'
                    AND compras.id_usuarios = '{$this->user->id}'"
            );

            foreach ( $libros as $libro )
            {
                $libro['url']     = urlencode($libro['id_libros'] . ' ' . $libro['titulo']);
                $libro['titulo'] .= $this->isModulo(MODULOS_LIBROS_CANTIDADES) ? " ({$libro['cantidad']})" : '';
                $this->block('compras.libros')->set($libro)->end();
            }
        }
    }
    
    public function __onSubmit()
    {
    }
}