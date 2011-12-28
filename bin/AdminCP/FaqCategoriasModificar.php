<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_FaqCategoriasModificar extends AdminCP_Base
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
            Web::redirect('/admincp/faq/categorias/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_faq_categorias'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'nombre' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::update('faq_categorias', array(
                'nombre' => trim( $_POST['nombre'] )
            ), "id_faq_categorias = '$id'");

            Web::redirect("/admincp/faq/categorias/$id/done/");
        }
    }

    public function modify( $id )
    {
        $result = Db::query(
            "SELECT faq_categorias.id_faq_categorias
                  , faq_categorias.nombre
             FROM faq_categorias
             WHERE faq_categorias.id_faq_categorias = '$id'"
        );

        if ( sizeof($result) == 0 )
            Web::redirect('/admincp/faq/categorias/error/');

        $categoria = $result[0];

        $this->title(
            array('Panel de Control', 'Preguntas Frecuentes', 'Categorias', $categoria['nombre'], 'Modificar')
        );

        $this->set($categoria)
             ->end();
    }
}