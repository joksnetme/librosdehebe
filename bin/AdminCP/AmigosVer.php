<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_AmigosVer extends AdminCP_Base
{
    public $type = 'text/html';

    protected $idAmigos = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->idAmigos = intval($argv[0]);

        $amigo = Db::query(
            "SELECT amigos.id_amigos
                  , CONCAT(amigos.tunombre, ' &lt;', amigos.tucorreo, '&gt;') AS de
                  , CONCAT(amigos.sunombre, ' &lt;', amigos.sucorreo, '&gt;') AS para
                  , amigos.tunombre AS de_nombre
                  , amigos.sunombre AS para_nombre
                  , amigos.mensaje
                  , amigos.fecha
                  , libros.id_libros
                  , libros.titulo AS libro
               FROM amigos
          LEFT JOIN libros
                 ON libros.id_libros = amigos.id_libros
              WHERE amigos.id_amigos = '$this->idAmigos'
           ORDER BY amigos.fecha DESC"
        );

        $amigo = $amigo[0];

        $amigo['fecha'] = date('d/m/Y H:i', $amigo['fecha']);
        $amigo['mensaje'] = textFormat($amigo['mensaje']);

        $this->set($amigo)->end()
             ->title( array('Panel de Control', 'Amigos', "{$amigo['de_nombre']} a {$amigo['para_nombre']}") );

        if ( $amigo['id_usuarios'] )
            $this->block('is_usuario')->end();
        else
            $this->block('is_not_usuario')->end();
    }
}