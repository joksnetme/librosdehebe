<?php

include_once "$root/bin/Base.php";

class UsuariosVer extends Base
{
    public $type = 'text/html';

    protected $id = 0;
    protected $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];
        $this->done = ( $argv[1] == 'done' );

        if ( $this->id && is_numeric($this->id) )
            $this->view($this->id);
    }

    public function view( $id )
    {
        if ( $this->done )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $result = Db::query(
            "SELECT usuarios.id_usuarios
                  , usuarios.nombre
                  , usuarios.ultimo
             FROM usuarios
             WHERE usuarios.id_usuarios = '$id'"
        );

        $user = $result[0];
        $user['ultimo'] = date('d/m/Y H:i', $user['ultimo']);

        $this->set($user)
             ->end();

        $this->title(
            array('Usuarios', $user['nombre'])
        );

        if ( $this->user->login && ( $id == $this->user->id || $this->user->admin ) )
        {
            $result = Db::query(
                "SELECT usuarios_datos.id_usuarios
                      , usuarios_datos.estado
                      , usuarios_datos.ciudad
                      , CONCAT(usuarios_datos.direccion1, ' ', usuarios_datos.direccion2) AS direccion
                      , CONCAT('(+', paises.codigo, ' ', usuarios_datos.codigo_area, ') ', usuarios_datos.telefono) AS telefono
                      , usuarios_datos.cp
                      , paises.pais
                 FROM usuarios_datos
                 INNER JOIN paises
                         ON paises.id_paises = usuarios_datos.id_paises
                 WHERE usuarios_datos.id_usuarios = '$id'"
            );

            if ( $result )
            {
                $datos = $result[0];

                $this->block('datos')
                     ->set($datos)
                     ->end();
            }

            $this->block('editable')->end();
        }
    }
}