<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_ColeccionesModificar extends AdminCP_Base
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
            Web::redirect('/admincp/colecciones/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_colecciones'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'nombre' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::update('colecciones', array(
                'nombre' => trim( $_POST['nombre'] )
            ), "id_colecciones = '$id'");

            Web::redirect("/admincp/colecciones/$id/done/");
        }
    }

    public function modify( $id )
    {
        $result = Db::query(
            "SELECT colecciones.id_colecciones
                  , colecciones.nombre
             FROM colecciones
             WHERE colecciones.id_colecciones = '$id'"
        );

        if ( sizeof($result) == 0 )
            Web::redirect('/admincp/colecciones/error/');

        $coleccion = $result[0];

        $this->title(
            array('Panel de Control', 'Colecciones', $coleccion['nombre'], 'Modificar')
        );

        $this->set($coleccion)
             ->end();
    }
}