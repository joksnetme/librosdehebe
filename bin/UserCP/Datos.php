<?php

include_once "$root/bin/UserCP/Base.php";

class UserCP_Datos extends UserCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $datos = Db::query(
            "SELECT usuarios_datos.estado
                  , usuarios_datos.ciudad
                  , usuarios_datos.direccion1
                  , usuarios_datos.direccion2
                  , usuarios_datos.codigo_area AS codigoArea
                  , usuarios_datos.telefono
                  , usuarios_datos.cp
                  , paises.id_paises
                  , paises.codigo
               FROM usuarios_datos
         INNER JOIN paises
                 ON paises.id_paises = usuarios_datos.id_paises
              WHERE usuarios_datos.id_usuarios = '{$this->user->id}'"
        );

        $paises = Db::query(
            "SELECT paises.id_paises
                  , paises.pais
                  , paises.codigo
             FROM paises
             ORDER BY paises.pais"
        );

        foreach ( $paises as $pais )
        {
            $pais['selected'] = $pais['id_paises'] == $datos[0]['id_paises'] ? ' selected="selected"' : '';

            $this->block('paises')
                 ->set($pais)
                 ->end();
        }

        $this->set($datos[0]);
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'pais'       => 'required',
            'estado'     => 'required',
            'ciudad'     => 'required',
            'direccion1' => 'required',
            'codigoArea' => 'required',
            'telefono'   => 'required',
            'cp'         => 'required'
        ));

        if ( $this->isValid() )
        {
            $isUserDatos = Db::query(
                "SELECT COUNT(*) AS isD
                 FROM usuarios_datos
                 WHERE id_usuarios = '{$this->user->id}'"
             );

            $datos = array(
                'id_usuarios' => $this->user->id,
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
                Db::update('usuarios_datos', $datos, "id_usuarios = '{$this->user->id}'");
            else
                Db::insert('usuarios_datos', $datos);

            header('Location: /usercp/datos/done/');
        }

        $this->set($_POST);
    }
}