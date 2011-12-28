<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Compras extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();

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
                
                $this->set(array('titulo' => 'Compras Realizadas', 'compraUrl' => 'realizadas', 'compra' => 'Realizadas'));
            break;
            
            case 'finalizadas':
                $where['completado'] = 1;
                $where['aprobado']   = 1;
                $where['enviado']    = 1;
                $where['rechazado']  = 0;
                
                $this->set(array('titulo' => 'Compras Finalizadas', 'compraUrl' => 'finalizadas', 'compra' => 'Finalizadas'));
            break;
            
            case 'pendientes':
                $where['completado'] = 0;
                $where['aprobado']   = 1;
                $where['rechazado']  = 0;
                $where['enviado']    = 0;
                
                $this->set(array('titulo' => 'Compras Pendientes', 'compraUrl' => 'pendientes', 'compra' => 'Pendientes'));
            break;
            
            case 'rechazadas':
                $where['rechazado']  = 1;
                $where['aprobado']   = 0;
                $where['enviado']    = 0;
                
                $this->set(array('titulo' => 'Compras Rechazadas', 'compraUrl' => 'rechazadas', 'compra' => 'Rechazadas'));
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
                    
                    $this->set(array('titulo' => 'Compras Pendientes de Aprobaci&oacute;n', 'compraUrl' => 'pendientes/aprobacion', 'compra' => 'Pendientes de Aprobaci&oacute;n'));
                break;
                
                case 'envio':
                    $where['completado'] = 1;
                    $where['rechazado']  = 0;
                    $where['aprobado']   = 1;
                    $where['enviado']    = 0;
                    
                    $this->set(array('titulo' => 'Compras Pendientes de Env&iacute;o', 'compraUrl' => 'pendientes/envio', 'compra' => 'Pendientes de Env&iacute;o'));
                break;
            }
        }
        
        $sqlWhere = '';

        foreach ( $where as $field => $value )
            $sqlWhere .= " compras.$field = '$value' AND";

        $sqlWhere = substr($sqlWhere, 0, -3);

        $compras = Db::query( 
            "SELECT compras.id_compras
                  , compras.fecha
                  , usuarios.id_usuarios
                  , usuarios.nombre AS usuario
                  , paises.pais
               FROM compras
         INNER JOIN usuarios
                 ON usuarios.id_usuarios = compras.id_usuarios
         INNER JOIN paises
                 ON paises.id_paises = compras.id_paises
              WHERE$sqlWhere"
        );
        
        foreach ( $compras as $i => $compra )
        {
            $precio = getCompraPrecio($compra['id_compras'], $this->user->id, $this->isModulo(MODULOS_LIBROS_OFERTAR), $this->isModulo(MODULOS_LIBROS_CANTIDADES));
            $fecha  = date('d/m/Y H:i', $compra['fecha']);

            $this->block('compras')->set(array(
                'precio'      => $precio,
                'fecha'       => $fecha,
                'usuario'     => $compra['usuario'],
                'pais'        => $compra['pais'],
                'id_usuarios' => $compra['id_usuarios'],
                'id_compras'  => $compra['id_compras'],
                'class'       => ++$i % 2 == 0 ? 'even' : 'odd'
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