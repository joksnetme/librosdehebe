<?php

class User
{
    public $login = false;
    public $admin = false;

    public $id = 0;
    public $data = array();

    public $extras = array();
    public $hasExtras = false;

    public function __construct( $idUsuarios = false )
    {
        $this->id = $idUsuarios | Cookies::get('LDH_UID');
        $this->login = ( $this->id ) ? true : false;

        $users = Db::query(
            "SELECT usuarios.id_usuarios
                  , usuarios.id_librerias
                  , usuarios.correo
                  , usuarios.nombre
                  , usuarios.admin
                  , usuarios.ultimo
             FROM usuarios
             WHERE usuarios.id_usuarios = '$this->id'"
        );

        $this->data = $users[0];
        $this->admin = ( $this->data['admin'] == 1 );

        $this->extras = Db::query(
            "SELECT usuarios_datos.id_usuarios
                  , usuarios_datos.estado
                  , usuarios_datos.ciudad
                  , usuarios_datos.direccion1
                  , usuarios_datos.direccion2
                  , usuarios_datos.codigo_area
                  , usuarios_datos.telefono
                  , usuarios_datos.cp
                  , paises.id_paises
                  , paises.pais
                  , paises.abbr
                  , paises.codigo
             FROM usuarios_datos
             INNER JOIN paises
                     ON paises.id_paises = usuarios_datos.id_paises
             WHERE usuarios_datos.id_usuarios = '$this->id'
             LIMIT 1"
        );
        
        $this->extras = $this->extras[0];

        $this->hasExtras = ( $this->extras ) ? true : false;
    }
}