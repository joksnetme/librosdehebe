<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_LibreriasModificar extends AdminCP_Base
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
            $this->modify($this->id);
        else
            Web::redirect('/admincp/librerias/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_librerias'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'nombre' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::update('librerias', array(
                'nombre' => trim( $_POST['nombre'] )
            ), "id_librerias = '$id'");

            Web::redirect("/admincp/librerias/$id/done/");
        }
    }

    public function modify( $id )
    {
        $result = Db::query(
            "SELECT librerias.id_librerias
                  , librerias.nombre
               FROM librerias
              WHERE librerias.id_librerias = '$id'"
        );

        if ( sizeof($result) == 0 )
            Web::redirect('/admincp/librerias/error/');

        $libreria = $result[0];

        $this->title(
            array('Panel de Control', 'Librerias', $libreria['nombre'], 'Modificar')
        );

        $this->set($libreria)
             ->end();
    }
}