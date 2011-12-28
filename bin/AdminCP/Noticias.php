<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Noticias extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Noticias');

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $result = Db::query(
            "SELECT noticias.id_noticias
                  , noticias.titulo
                  , noticias.descripcion
                  , noticias.fecha
                  , GROUP_CONCAT(noticias_etiquetas.etiqueta ORDER BY noticias_etiquetas.id_noticias_etiquetas SEPARATOR ' ' )  AS etiquetas
               FROM noticias
          LEFT JOIN noticias_etiquetas
                 ON noticias_etiquetas.id_noticias = noticias.id_noticias
           GROUP BY noticias.id_noticias
           ORDER BY noticias.fecha DESC"
        );

        foreach ( $result as $i => $value )
        {
            $this->block('each')->set(array(
                'id'          => $value['id_noticias'],
                'class'       => ++$i % 2 == 0 ? 'even' : 'odd',
                'pos'         => $i,
                'titulo'      => $value['titulo'],
                'descripcion' => $value['descripcion'],
                'etiquetas'   => $value['etiquetas'],
                'fecha'       => date('d/m/Y H:i', $value['fecha'])
            ))->end();
        }
    }
}