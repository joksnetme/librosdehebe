<?php

include_once "$root/bin/Base.php";

class CarritoFinalizar2 extends Base
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
            "SELECT compras.id_compras
                  , compras.id_pagos
                  , compras.id_envios
                  , compras.estado
                  , compras.ciudad
                  , compras.nombre
                  , compras.direccion1
                  , compras.direccion2
                  , compras.codigo_area
                  , compras.telefono
                  , compras.cp
                  , compras.fecha
                  , paises.id_paises
                  , paises.pais
                  , envios.precio AS precioEnvio
               FROM compras
          LEFT JOIN paises
                 ON paises.id_paises = compras.id_paises
          LEFT JOIN envios
                 ON envios.id_envios = compras.id_envios
              WHERE compras.id_compras = '$this->idCompras'
                AND compras.id_usuarios = '{$this->user->id}'"
        );
        
        $compra = $compra[0];
        
        if ( $compra['id_pagos'] == 0 && isset($_POST['pago']) )
            $compra['id_pagos'] = intval($_POST['pago']);
            
        if ( $compra['id_envios'] == 0 && isset($_POST['envios']) )
            $compra['id_envios'] = intval($_POST['envios']);
        
        if ( strlen($compra['id_compras']) == 0 )
            Web::redirect('/');

        $idPaises = $compra['id_paises'];
        
        $this->set($compra);
        
        $pagos = Db::query(
            "SELECT pagos.id_pagos
                  , pagos.nombre
               FROM pagos"
        );
        
        foreach ( $pagos as $pago )
        {
            $pago['checked'] = $compra['id_pagos'] == $pago['id_pagos'] ? ' checked="checked"' : '';
            $this->block('pagos')->set($pago)->end();
        }
            
        
        $books = Db::query(
            "SELECT carrito.cantidad
               FROM compras
         INNER JOIN compras_items
                 ON compras_items.id_compras = compras.id_compras
         INNER JOIN carrito
                 ON carrito.id_carrito = compras_items.id_carrito
              WHERE compras.id_compras = '{$compra['id_compras']}'"
        );

        $bookCount = 0;
        
        foreach ( $books as $book )
        {
            $bookCount += $this->isModulo(MODULOS_LIBROS_CANTIDADES)
                        ? $books[0]['cantidad']
                        : 1;
        }
        
        $this->set('bookCount', $bookCount);
        
        $precios = Db::query(
            "SELECT libros.precio
                  , carrito.oferta
                  , carrito.cantidad
               FROM compras
         INNER JOIN compras_items
                 ON compras_items.id_compras = compras.id_compras
         INNER JOIN carrito
                 ON carrito.id_carrito = compras_items.id_carrito
         INNER JOIN libros
                 ON libros.id_libros = carrito.id_libros
              WHERE compras.id_compras = '{$compra['id_compras']}'"
        );
        
        $booksPrice = 0;
        
        foreach ( $precios as $precio )
        {
            $precioOf = $precio['oferta'] > 0 && $this->isModulo(MODULOS_LIBROS_OFERTAR)
                      ? $precio['oferta']
                      : $precio['precio'];
                    
            $cantidad = $this->isModulo(MODULOS_LIBROS_CANTIDADES)
                      ? $precio['cantidad']
                      : 1;
                          
            $booksPrice += $precioOf * $cantidad;
        }
        
        $this->set('booksPrice', $booksPrice);
        
        $booksPriceFinal = $booksPrice;
        
        if ( strlen($compra['precioEnvio']) > 0 )
            $booksPriceFinal += $compra['precioEnvio'];
        
        $this->set('finalPrice', $booksPriceFinal);
        
        $envios = $this->filterByCant($bookCount, Db::query(
            "SELECT envios.id_envios
                  , envios.id_paises
                  , envios.nombre
                  , envios.cantidad_tipo
                  , envios.cantidad
                  , envios.entrega
                  , envios.precio
               FROM envios
           ORDER BY envios.id_paises
                  , envios.precio"
        ));
        
        $enviosDisponibles = array();
        
        foreach ( $envios as $envio )
        {
            if ( $idPaises == $envio['id_paises'] )
                $enviosDisponibles[] = $envio;
        }
        
        if ( count($enviosDisponibles) == 0 )
        {
            foreach ( $envios as $envio )
            {
                if ( $envio['id_paises'] == 0 )
                    $enviosDisponibles[] = $envio;
            }
        }
        
        foreach ( $enviosDisponibles as $envio )
        {
            $envio['checked'] = $compra['id_envios'] == $envio['id_envios'] ? ' checked="checked"' : '';
            $this->block('envios')->set($envio)->end();
        }
    }
    
    public function __onSubmit()
    {
        $this->validation(array(
            'pago'   => 'required',
            'envios' => 'required'
        ));
        
        if ( $this->isValid() ){
                
            Db::update('compras', array(
                'id_pagos' => intval($_POST['pago']), 
                'id_envios' => intval($_POST['envios'])
            ), "id_compras = '$this->idCompras' AND id_usuarios = '{$this->user->id}'");
             
            Web::redirect("/carrito/finalizar/$this->idCompras/3/");
        }
    }
    
    private function filterByCant( $bookCount, $envios )
    {
        $result = array();
        $i = -1;
        
        while ( $envios[++$i] )
        {
            $continue = false;
            
            switch( $envios[$i]['cantidad_tipo'] )
            {
              # cantidad de libros por envio ( switch ) cantidad de libros en el carrito
                case '<':
                    if ( $bookCount >= $envios[$i]['cantidad'] )
                        $continue = true;
                break;
                case '>':
                    if ( $bookCount <= $envios[$i]['cantidad'] )
                        $continue = true;
                break;
                case '=':
                    if ( $bookCount != $envios[$i]['cantidad'] )
                        $continue = true;
                break;
            }
            
            if ( $continue )
                continue;

            $result[] = $envios[$i];
        }
        
        return $result;
    }
}