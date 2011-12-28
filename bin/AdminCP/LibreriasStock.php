<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_LibreriasStock extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = intval($argv[0]);

        $result = Db::query(
            "SELECT librerias.id_librerias
                  , librerias.nombre
               FROM librerias
              WHERE librerias.id_librerias = '$this->id'"
        );

        $libreria = $result[0];

        $this->title(
            array('Panel de Control', 'Librerias', $libreria['nombre'], 'Stock')
        );

        $this->set($libreria)
             ->end();

        $libros = Db::query(
            "SELECT libros.id_libros
                  , libros.titulo
                  , autores.nombre AS autor
                  , IF(ISNULL(librerias_stock.cantidad), 0, librerias_stock.cantidad) AS cantidad
               FROM libros
         INNER JOIN autores
                 ON autores.id_autores = libros.id_autores
          LEFT JOIN librerias_stock
                 ON librerias_stock.id_librerias = '$this->id'
                AND librerias_stock.id_libros = libros.id_libros"
        );

        $pos = 1;

        foreach ( $libros as $libro )
        {
            $libro['id_librerias'] = $this->id;

            $this->block('each')
                 ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                 ->set('pos', $pos)
                 ->set($libro)
                 ->end();

            $pos++;
        }
    }
}