<?php

include_once "$root/bin/Base.php";

class Carrito extends Base
{
    public $type = 'text/html';

    protected $costoEnvio = 0;
    protected $where = '';

    public function __construct( $argv = array() )
    {
        parent::__construct('Carrito de Compras');

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $this->nav('Carrito');
        $this->where = $this->user->login
                     ? "carrito.id_usuarios = '{$this->user->id}' OR carrito.ip = '" . Web::getIp() . "'"
                     : "carrito.ip = '" . Web::getIp() . "'";

        $libros = Db::query(
            "SELECT carrito.id_carrito
                  , carrito.cantidad
                  , carrito.fecha
                  , carrito.oferta
                  , libros.id_libros
                  , libros.isbn
                  , libros.anho
                  , libros.tomos
                  , libros.titulo
                  , libros.precio
                  , libros.paginas
                  , autores.nombre AS autor
                  , editoriales.nombre AS editorial
               FROM carrito
         INNER JOIN libros
                 ON libros.id_libros = carrito.id_libros
         INNER JOIN autores
                 ON autores.id_autores = libros.id_autores
         INNER JOIN editoriales
                 ON editoriales.id_editoriales = libros.id_editoriales
              WHERE ( $this->where )
                AND carrito.finalizado = 0
           ORDER BY carrito.fecha DESC"
        );

        if ( count($libros) == 0 )
            $this->block('empty')->end();
        else
        {
            $this->costoEnvio = $this->getCostoEnvio();
            $total = $this->costoEnvio;

            foreach ( $libros as $value )
            {
                $precio = $value['oferta'] > 0 && $this->isModulo(MODULOS_LIBROS_OFERTAR)
                        ? $value['oferta']
                        : $value['precio'];

                $cantidad = $this->isModulo(MODULOS_LIBROS_CANTIDADES)
                          ? $value['cantidad']
                          : 1;

                $total += ( $precio * $cantidad );
            }

            $this->block('hayLibros')->set(array(
                'total' => number_format($total, 2, '.', '')
            ))->end();

            if ( $this->costoEnvio == 0 )
                $this->block('hayLibros.noHayCosto')->end();
            else
                $this->block('hayLibros.costoDeEnvio')
                     ->set('costoEnvio', $this->costoEnvio)
                     ->end();

            if ( $this->user->login && !( $this->user->hasExtras ) )
                $this->block('hayLibros.noUserData')->end();

            if ( $this->isModulo(MODULOS_LIBROS_CANTIDADES) )
                $this->block('hayLibros.cantidades')->end();

            foreach ( $libros as $value )
            {
                $cantidad = $this->isModulo(MODULOS_LIBROS_CANTIDADES)
                          ? $value['cantidad']
                          : 1;

                $value['url']          = urlencode($value['id_libros'] . ' ' . $value['titulo']);
                $value['autorUri']     = buscarURI(array('autor' => $value['autor']));
                $value['editorialUri'] = buscarURI(array('editorial' => $value['editorial']));
              # $value['precio']       = number_format($value['precio'] * $cantidad, 2, '.', '');

                if ( is_file( $imagen = "upl/libros/{$value['id_libros']}/75x100/i.jpg" ) )
                    $value['imagen'] = "/$imagen";

                if ( strlen($value['titulo']) > 75 )
                    $value['titulo'] = substr($value['titulo'], 0, 75) . '...';

                $this->block('hayLibros.libros')->set($value)->end();

                if ( $value['anho'] > 0 && $value['anho'] < 9999 )
                    $this->block('hayLibros.libros.anho')->end();

                if ( strlen($value['isbn']) > 0 )
                    $this->block('hayLibros.libros.isbn')->end();

                if ( $this->isModulo(MODULOS_LIBROS_CANTIDADES) )
                    $this->block('hayLibros.libros.cantidades')->end();

                if ( $value['oferta'] > 0 && $this->isModulo(MODULOS_LIBROS_OFERTAR) )
                    $this->block('hayLibros.libros.ofertar')->end();
            }

            if ( $this->isModulo(MODULOS_LIBROS_CANTIDADES) || $this->isModulo(MODULOS_LIBROS_OFERTAR) )
                $this->block('hayLibros.actualizar')->end();
        }
    }

    public function __onSubmit()
    {
        $where  = "carrito.id_carrito = '%s' AND ( $this->where ) ";

        if ( is_array($_POST['cantidad']) )
        {
            foreach ( $_POST['cantidad'] as $id_carrito => $cantidad )
            {
                if ( is_numeric($cantidad) || $cantidad == 0 )
                {
                    if ( $cantidad > 0 )
                        Db::update('carrito', array(
                            'cantidad' => intval($cantidad)
                        ), sprintf($where, intval($id_carrito)));
                    else
                    {
                        Db::query(
                            "DELETE FROM carrito
                                   WHERE " . sprintf($where, intval($id_carrito)) . "
                                   LIMIT 1"
                        );
                    }
                }
            }
        }

        if ( is_array($_POST['oferta']) )
        {
            foreach ( $_POST['oferta'] as $id_carrito => $oferta )
            {
                if ( is_numeric($oferta) && $oferta > 0 )
                {
                    Db::update('carrito', array(
                        'oferta' => $oferta
                    ), sprintf($where, intval($id_carrito)));
                }
            }
        }
        
        $end = isset($_POST['submit']) ? 'finalizar/' : '';

        header("Location: /carrito/$end");
    }

    private function getCostoEnvio()
    {
        $items    = Db::query("SELECT carrito.cantidad FROM carrito WHERE $this->where");
        $numItems = 0;

        foreach ( $items as $item )
            $numItems += $item['cantidad'];

        $envios = Db::query("SELECT envios.* FROM envios");
        
        /*$user   = Db::query(
            "SELECT usuarios_datos.id_paises
               FROM usuarios_datos
              WHERE usuarios_datos.id_usuarios = '{$this->user->id}'"
        );*/

        $precio = 0;

        foreach ( $envios as $envio )
        {
            $addShipment = false;

            if ( $envio['local'] && $this->user->extras['id_paises'] == $envio['id_paises'] )
                $addShipment = true;

            if ( $addShipment )
            {
                $cantidad = $envio['cantidad'] * 1;

                switch ( $envio['cantidad_tipo'] )
                {
                    case '<':
                        if ( !( $numItems < $cantidad ) )
                            $addShipment = false;
                    break;

                    case '>':
                        if ( !( $numItems > $cantidad ) )
                            $addShipment = false;
                    break;

                    case '=':
                        if ( !( $numItems == $cantidad ) )
                            $addShipment = false;
                    break;
                }
            }

            if ( $addShipment )
            {
                if ( $envio['precio'] < $precio || $precio == 0 )
                    $precio = $envio['precio'];
            }
        }

        return $precio;
    }
}