<?php

include_once "$root/bin/BaseLoginAdmin.php";

class Usuarios extends BaseLoginAdmin
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Usuarios');

        $result = Db::query(
            "SELECT usuarios.id_usuarios
                  , usuarios.correo
                  , usuarios.nombre
                  , usuarios.ultimo
                  , IF(NOT(ISNULL(librerias.nombre)), librerias.nombre, '-') AS libreria
               FROM usuarios
          LEFT JOIN librerias
                 ON librerias.id_librerias = usuarios.id_librerias
           ORDER BY usuarios.ultimo DESC"
        );

        if ( ( $numRows = sizeof($result) ) > 0 )
        {
            $pos = 0;

            foreach ( $result as $row )
            {
                $pos++;
                $row['ultimo'] = date('d/m/Y H:i', $row['ultimo']);

                $this->block('each')
                     ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                     ->set('pos', $pos)
                     ->set('id', $row['id_usuarios'])
                     ->set($row)
                     ->end();
            }
        }
    }
}