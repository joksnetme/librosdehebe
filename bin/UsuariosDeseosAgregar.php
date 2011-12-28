<?php

include_once "$root/bin/BaseLogin.php";

class UsuariosDeseosAgregar extends BaseLogin
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $idUsuarios = intval($argv[0]);
        $idLibros   = intval($argv[1]);

        if ( $this->user->id == $idUsuarios || $this->user->admin )
        {
            $result = Db::query(
                "SELECT COUNT(*) AS num
                   FROM deseos
                  WHERE deseos.id_usuarios = '$idUsuarios'
                    AND deseos.id_libros = '$idLibros'"
            );

            if ( $result[0]['num'] == 0 )
            {
                Db::insert('deseos', array(
                    'id_usuarios' => $idUsuarios,
                    'id_libros'   => $idLibros,
                    'fecha'       => time()
                ));
            }
        }

        Web::redirect("/usuarios/$idUsuarios/deseos/done/");
    }
}