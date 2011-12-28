<?php

include_once "$root/bin/Base.php";

class CarritoFinalizar3 extends Base
{
    public $type = 'text/html';

    private $idCompras = 0;
    
    public function __construct( $argv = array() )
    {
        parent::__construct('Carrito de Compras');

        if ( !$this->user->login )
            Web::redirect('/login/');
            
        $this->idCompras = intval($argv[0]);
        
        $compra = Db::query(
            "SELECT compras.*
                  , paises.pais
                  , pagos.nombre AS pago
                  , envios.nombre AS envio
                  , envios.precio AS envioPrecio
                  , envios.entrega
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
        
        $this->set($compra);
        
        $items = Db::query(
            "SELECT compras.id_compras
                  , envios.precio AS costoEnvio
                  , libros.id_libros
                  , libros.isbn
                  , libros.anho
                  , libros.tomos
                  , libros.titulo
                  , libros.precio
                  , libros.paginas
                  , autores.nombre AS autor
                  , editoriales.nombre AS editorial
                  , carrito.cantidad
                  , carrito.oferta
               FROM compras
         INNER JOIN compras_items
                 ON compras_items.id_compras = compras.id_compras
         INNER JOIN carrito
                 ON carrito.id_carrito = compras_items.id_carrito
         INNER JOIN libros
                 ON libros.id_libros = carrito.id_libros
         INNER JOIN autores
                 ON autores.id_autores = libros.id_autores
         INNER JOIN editoriales
                 ON editoriales.id_editoriales = libros.id_editoriales
         INNER JOIN envios
                 ON envios.id_envios = compras.id_envios
              WHERE compras.id_compras = '$this->idCompras'
                AND compras.id_usuarios = '{$this->user->id}'"
        );
        
        $this->set('costoEnvio', $items[0]['costoEnvio']);
        
        $precioFinal = $this->get('costoEnvio');
        
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
            
            $precioFinal += ( $item['precio'] * $item['cantidad'] );
            
            $this->block('libros')->set($item)->end();
            
            if ( $item['anho'] > 0 && $item['anho'] < 9999 )
                $this->block('libros.anho')->end();

            if ( strlen($item['isbn']) > 0 )
                $this->block('libros.isbn')->end();

            if ( $this->isModulo(MODULOS_LIBROS_CANTIDADES) )
                $this->block('libros.cantidades')->end();
        }
        
        $this->set('costoFinal', $precioFinal);
    }
    
    public function __onSubmit(){
        
        $compra = Db::query(
            "SELECT COUNT(carrito.id_carrito) AS ofertas
                  , pagos.digitos
               FROM compras
         INNER JOIN compras_items
                 ON compras_items.id_compras = compras.id_compras
          LEFT JOIN carrito
                 ON carrito.id_carrito = compras_items.id_carrito
                AND carrito.oferta > 0
         INNER JOIN pagos
                 ON pagos.id_pagos = compras.id_pagos
              WHERE compras.id_compras = '$this->idCompras'
                AND compras.id_usuarios = '{$this->user->id}'
           GROUP BY compras.id_compras"
        );
        
        $update = array(
            'finalizado' => 1
        );
        
        // oferta == 0 = aprobado = 1
        if ( $compra[0]['ofertas'] == 0 )
            $update['aprobado'] = 1;
            
        // digitos == 0 = completado = 1
        if ( $compra[0]['digitos'] == 0 )
            $update['completado'] = 1;
            
        Db::update('compras', $update, "id_compras = '$this->idCompras' AND id_usuarios = '{$this->user->id}'");
        
        Web::redirect('/usercp/compras/done/');
    }
}