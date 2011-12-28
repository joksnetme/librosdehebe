<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_AutoresModificar extends AdminCP_Base
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
            Web::redirect('/admincp/autores/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_autores'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'nombre' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::update('autores', array(
                'nombre' => trim( $_POST['nombre'] )
            ), "id_autores = '$id'");

            Web::redirect("/admincp/autores/$id/done/");
        }
    }

    public function modify( $id )
    {
        $result = Db::query(
            "SELECT autores.id_autores
                  , autores.nombre
             FROM autores
             WHERE autores.id_autores = '$id'"
        );

        if ( sizeof($result) == 0 )
            Web::redirect('/admincp/autores/error/');

        $autor = $result[0];

        $this->title(
            array('Panel de Control', 'Autores', $autor['nombre'], 'Modificar')
        );

        $this->set($autor)
             ->end();
    }
}