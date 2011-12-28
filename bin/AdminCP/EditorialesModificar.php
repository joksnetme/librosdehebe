<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_EditorialesModificar extends AdminCP_Base
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
            Web::redirect('/admincp/editoriales/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_editoriales'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'nombre' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::update('editoriales', array(
                'nombre' => trim( $_POST['nombre'] )
            ), "id_editoriales = '$id'");

            Web::redirect("/admincp/editoriales/$id/done/");
        }
    }

    public function modify( $id )
    {
        $result = Db::query(
            "SELECT editoriales.id_editoriales
                  , editoriales.nombre
             FROM editoriales
             WHERE editoriales.id_editoriales = '$id'"
        );

        if ( sizeof($result) == 0 )
            Web::redirect('/admincp/editoriales/error/');

        $editorial = $result[0];

        $this->title(
            array('Panel de Control', 'Editoriales', $editorial['nombre'], 'Modificar')
        );

        $this->set($editorial)
             ->end();
    }
}