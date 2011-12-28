<?php

include_once "$root/bin/UserCP/Base.php";

class UserCP_ComprasDetalles extends UserCP_Base
{
    public $type = 'text/html';

    private $idCompras = 0;
    
    public function __construct( $argv = array() )
    {
        parent::__construct();
        
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

        foreach ( $compras as $compra )
        {
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
        
        
        
        
        
        $this->idCompras = intval($argv[0]);

        $compra = Db::query(
            "SELECT compras.*
                  , paises.pais
                  , pagos.nombre AS pago
                  , envios.nombre AS envio
                  , envios.entrega
                  , envios.precio AS precioEnvio
               FROM compras
         INNER JOIN paises
                 ON paises.id_paises = compras.id_paises
         INNER JOIN pagos
                 ON pagos.id_pagos = compras.id_pagos
         INNER JOIN envios
                 ON envios.id_envios = compras.id_envios
              WHERE compras.id_compras = '$this->idCompras'
                AND compras.id_usuarios = '{$this->user->id}'"
        );
        
        $compra = $compra[0];
        $compra['envio'] .= " ({$compra['entrega']} dias laborales)";
        
        $compra['fecha'] = date('d/m/Y H:i', $compra['fecha']);
        
        if ( strlen($compra['comprobante']) > 0 )
            $compra['pago'] .= " (Comprobante N&uacute;mero: {$compra['comprobante']})";

        define(realizada,            'Realizada');
        define(finalizada,           'Finalizada');
        define(pendiente_aprobacion, 'Pendiente de Aprobaci&oacute;n');
        define(pendiente,            'Pendiente');
        define(rechazada,            'Rechazada');

        $estados = array(
            realizada            => array('1-1-0-1-0'),
            finalizada           => array('1-1-1-1-0'),
            pendiente_aprobacion => array('1-1-0-0-0', '1-0-0-0-0'),
            pendiente            => array('1-0-0-1-0'),
            rechazada            => array('1-1-0-0-1', '1-0-0-0-1')
        );

        foreach ( $estados as $estadoNombre => $estadoExp ){
            $compraEstado = sprintf('%s-%s-%s-%s-%s', $compra['finalizado'], $compra['completado'], $compra['enviado'], $compra['aprobado'], $compra['rechazado']);
            if ( in_array($compraEstado, $estadoExp ) ){
                $compra['estadoCompra'] = $estadoNombre;
                break;
            }
        }

        $this->set($compra);

        $precioTotal = getCompraPrecio($this->idCompras, $this->user->id, $this->isModulo(MODULOS_LIBROS_OFERTAR), $this->isModulo(MODULOS_LIBROS_CANTIDADES));

        $this->set('precioTotal', $precioTotal);

        $items = Db::query(
            "SELECT libros.id_libros
                  , libros.isbn
                  , libros.anho
                  , libros.tomos
                  , libros.titulo
                  , libros.precio
                  , libros.paginas
                  , autores.nombre AS autor
                  , editoriales.nombre AS editorial
                  , carrito.oferta
                  , carrito.cantidad
               FROM compras_items
         INNER JOIN carrito
                 ON carrito.id_carrito = compras_items.id_carrito
         INNER JOIN libros
                 ON libros.id_libros = carrito.id_libros
         INNER JOIN autores
                 ON autores.id_autores = libros.id_autores
         INNER JOIN editoriales
                 ON editoriales.id_editoriales = libros.id_editoriales
              WHERE compras_items.id_compras = '{$compra['id_compras']}'"
        );
        
        foreach ( $items as $item )
        {
            $item['url']          = urlencode($item['id_libros'] . ' ' . $item['titulo']);
            $item['autorUri']     = buscarURI(array('autor' => $item['autor']));
            $item['editorialUri'] = buscarURI(array('editorial' => $item['editorial']));

            if ( is_file( $imagen = "upl/libros/{$item['id_libros']}/75x100/i.jpg" ) )
                    $item['imagen'] = "/$imagen";

            if ( strlen($item['titulo']) > 75 )
                $item['titulo'] = substr($item['titulo'], 0, 75) . '...';

            if ( $item['oferta'] > 0 && $this->isModulo(MODULOS_LIBROS_OFERTAR) )
                $item['precio'] = $item['oferta'];

            if ( !$this->isModulo(MODULOS_LIBROS_CANTIDADES) )
                $item['cantidad'] = 1;

            $this->block('libros')->set($item)->end();

            if ( $item['anho'] > 0 && $item['anho'] < 9999 )
                $this->block('libros.anho')->end();

            if ( strlen($item['isbn']) > 0 )
                $this->block('libros.isbn')->end();

            if ( $this->isModulo(MODULOS_LIBROS_CANTIDADES) )
                $this->block('libros.cantidades')->end();
        }
        
    }

}