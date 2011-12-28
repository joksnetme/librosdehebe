<?php

include_once "$root/bin/BaseLogin.php";

class UsuariosModificar extends BaseLogin
{
    public $type = 'text/html';

    protected $id = 0;
    protected $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];
        $this->done = ( $argv[1] == 'done' );

        if ( $this->id )
        {
            if ( !( $this->id == $this->user->id || $this->user->admin ) )
                Web::redirect("/usuarios/$this->id/");

            $this->modify($this->id);
        }
        else
            Web::redirect('/usuarios/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_usuarios'];

        if ( !( $id ) || $id != $this->id )
            return;

        $validation = array(
            'nombre' => 'required',
            'clave'  => array( 'rangeLength' => array(6, 12) ),
            'clave2' => array( 'equalTo' => $_POST['clave'] )
        );

        if ( $this->user->login && ( $id == $this->user->id || $this->user->admin ) )
        {
            $validation = array_merge($validation, array(
                'pais'       => 'required',
                'estado'     => 'required',
                'ciudad'     => 'required',
                'direccion1' => 'required',
                'codigoArea' => 'required',
                'telefono'   => 'required',
                'cp'         => 'required'
            ));
        }

        $this->validation($validation);

        if ( $this->isValid() )
        {
            $fields = array(
                'nombre'       => trim( $_POST['nombre'] ),
                'id_librerias' => intval($_POST['libreria'])
            );

            if ( strlen($_POST['clave']) > 0 )
                $fields['clave'] = md5( $_POST['clave'] );

            Db::update('usuarios', $fields, "id_usuarios = '$id'");

            if ( $this->user->login && ( $id == $this->user->id || $this->user->admin ) )
            {
                $isUserDatos = Db::query(
                    "SELECT COUNT(*) AS isD
                     FROM usuarios_datos
                     WHERE id_usuarios = '$id'"
                 );

                $datos = array(
                    'id_usuarios' => $id,
                    'id_paises'   => intval( $_POST['pais'] ),
                    'estado'      => $_POST['estado'],
                    'ciudad'      => $_POST['ciudad'],
                    'direccion1'  => $_POST['direccion1'],
                    'direccion2'  => $_POST['direccion2'],
                    'codigo_area' => $_POST['codigoArea'],
                    'telefono'    => $_POST['telefono'],
                    'cp'          => $_POST['cp']
                );

                if ( $isUserDatos[0]['isD'] == 1 )
                    Db::update('usuarios_datos', $datos, "id_usuarios = '$id'");
                else
                    Db::insert('usuarios_datos', $datos);
            }

            Web::redirect("/usuarios/$id/done/");
        }

        $this->set($_POST);
    }

    public function modify( $id )
    {
        $result = Db::query(
            "SELECT usuarios.id_usuarios
                  , usuarios.id_librerias
                  , usuarios.nombre
                  , usuarios.correo
             FROM usuarios
             WHERE usuarios.id_usuarios = '$id'"
        );

        $user = $result[0];

        $this->title(
            array('Usuarios', $user['nombre'], 'Modificar')
        );

        $this->set($user)
             ->end();

        if ( $this->user->login && ( $id == $this->user->id || $this->user->admin ) )
        {
            $this->block('datos')
                 ->end();

            $datos  = array();
            $result = Db::query(
                "SELECT usuarios_datos.id_usuarios
                      , usuarios_datos.estado
                      , usuarios_datos.ciudad
                      , usuarios_datos.direccion1
                      , usuarios_datos.direccion2
                      , usuarios_datos.codigo_area AS codigoArea
                      , usuarios_datos.telefono
                      , usuarios_datos.cp
                      , paises.id_paises
                      , paises.pais
                      , paises.codigo
                 FROM usuarios_datos
                 INNER JOIN paises
                         ON paises.id_paises = usuarios_datos.id_paises
                 WHERE usuarios_datos.id_usuarios = '$id'"
            );

            if ( $result )
            {
                $datos = $result[0];

                $this->set($datos)
                     ->end();
            }

            $paises = Db::query(
                "SELECT paises.id_paises
                      , paises.pais
                      , paises.codigo
                 FROM paises
                 ORDER BY paises.pais"
            );

            foreach ( $paises as $pais )
            {
                $pais['selected'] = $pais['id_paises'] == $datos['id_paises'] ? ' selected="selected"' : '';

                $this->block('datos.paises')
                     ->set($pais)
                     ->end();
            }
            
            if ( $this->user->admin ){
                
                $librerias = Db::query(
                    "SELECT librerias.id_librerias
                          , librerias.nombre AS libreria
                          , IF(NOT(ISNULL(usuarios.id_usuarios)), 'selected=\"selected\"', '') AS selected
                       FROM librerias
                  LEFT JOIN usuarios
                         ON usuarios.id_usuarios = '$this->id'
                        AND usuarios.id_librerias = librerias.id_librerias"
                );

                $this->block('librerias')->end();

                foreach ( $librerias as $libreria )
                     $this->block('librerias.options')->set($libreria)->end();
            }
        }
    }
}