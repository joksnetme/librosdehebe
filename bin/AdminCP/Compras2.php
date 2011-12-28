<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Compras extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Compras');

        $compras = Db::query(
            "SELECT compras.*
                  , usuarios.nombre AS usuario
                  , paises.pais
               FROM compras
         INNER JOIN usuarios
                 ON usuarios.id_usuarios = compras.id_usuarios
         INNER JOIN paises
                 ON paises.id_paises = compras.id_paises
              WHERE compras.finalizado = 1"
        );
        
        $pendientes           = array();
        $pendientesAprobacion = array();
        $pendientesEnvio      = array();
        
        foreach ( $compras as $compra ){
            if ( $compra['enviado'] == 0 && $compra['rechazado'] == 0 ) {
                if ( $compra['completado'] == 0 && $compra['aprobado'] == 1 )
                    $pendientes[] = $compra;
                    
                elseif ( $compra['aprobado'] == 0 )
                    $pendientesAprobacion[] = $compra;
                    
                elseif ( $compra['completado'] == 1 && $compra['aprobado'] == 1 && $compra['enviado'] == 0 )
                    $pendientesEnvio[] = $compra;
            }
        }
        
        if ( count($pendientes) )
            $this->block('TituloPendientes')->end();
        
        foreach ( $pendientes as $i => $compraPendiente )
            $this->showComprasLibros($i, 'compras', $compraPendiente);
        
        if ( count($pendientesAprobacion) )
            $this->block('TituloPendientesAprobacion')->end();
        
        foreach ( $pendientesAprobacion as $i => $compraPendienteAprobacion )
            $this->showComprasLibros($i, 'compras2', $compraPendienteAprobacion);
            
        if ( count($pendientesEnvio) )
            $this->block('TituloPendientesEnvio')->end();
                
        foreach ( $pendientesEnvio as $i => $compraPendienteEnvio )
            $this->showComprasLibros($i, 'compras3', $compraPendienteEnvio);
        
    }        
    
    function showComprasLibros ( $i, $block, $compra ){
    
        $precio = getCompraPrecio($compra['id_compras'], $this->user->id, $this->isModulo(MODULOS_LIBROS_OFERTAR), $this->isModulo(MODULOS_LIBROS_CANTIDADES));
        $fecha  = date('d/m/Y H:i', $compra['fecha']);

        $this->block($block)->set(array(
            'precio'      => $precio,
            'fecha'       => $fecha,
            'id_compras'  => $compra['id_compras'],
            'id_usuarios' => $compra['id_usuarios'],
            'comprobante' => $compra['comprobante'],
            'usuario'     => $compra['usuario'],
            'pais'        => $compra['pais'],
            'class'       => $i % 2 == 0 ? 'even' : 'odd'
        ))->end();

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
            $this->block("$block.libros")->set($libro)->end();
        }
    }
}