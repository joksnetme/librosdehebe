<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Amigos extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Amigos');

        $amigos = Db::query(
            "SELECT amigos.id_amigos
                  , CONCAT(amigos.tunombre, ' &lt;', amigos.tucorreo, '&gt;') AS de
                  , CONCAT(amigos.sunombre, ' &lt;', amigos.sucorreo, '&gt;') AS para
                  , amigos.fecha
                  , libros.id_libros
                  , libros.titulo AS libro
               FROM amigos
          LEFT JOIN libros
                 ON libros.id_libros = amigos.id_libros
           ORDER BY amigos.fecha DESC"
        );

        $pos = 1;

        foreach ( $amigos as $amigo )
        {
            $amigo['fecha'] = date('d/m/Y H:i', $amigo['fecha']);
            $amigo['class'] = ( $pos % 2 == 0 ) ? 'even' : 'odd';
            $amigo['pos']   = $pos;

            $this->block('each')
                 ->set($amigo)
                 ->end();

            if ( $amigo['id_usuarios'] )
                $this->block('each.is_usuario')->end();
            else
                $this->block('each.is_not_usuario')->end();

            $pos++;
        }

    }
}