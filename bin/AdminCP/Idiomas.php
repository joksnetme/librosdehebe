<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Idiomas extends AdminCP_Base
{
    public $type = 'text/html';

    private $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct('Paises');

        $this->done = ( $argv[0] == 'done' );

        if ( $this->done )
            $this->block('validation')->end()
                 ->block('validation.done')->end();

        $idiomas = Db::query(
            "SELECT idiomas.id_idiomas
                  , idiomas.nombre AS idioma
                  , idiomas.abbr
                  , COUNT(libros.id_libros) AS libros
                  , SUM(libros.precio) AS precio
               FROM idiomas
               LEFT JOIN libros
                      ON libros.id_idiomas = idiomas.id_idiomas
             GROUP BY idiomas.id_idiomas
           ORDER BY idiomas.nombre"
        );

        $pos = 1;
        $precio = 0;

        foreach ( $idiomas as $idioma )
        {
            $precio += $idioma['precio'];

            $idioma['class']  = ( $pos % 2 == 0 ) ? 'even' : 'odd';
            $idioma['pos']    = $pos++;
            $idioma['precio'] = number_format($idioma['precio'], 2);

            $this->block('each')
                 ->set($idioma)
                 ->end();
        }

        $this->set('precio', number_format($precio, 2));
    }
}