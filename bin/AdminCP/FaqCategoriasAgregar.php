<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_FaqCategoriasAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct(array('Preguntas Frecuentes', 'Categorias', 'Agregar'));
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'nombre' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::insert('faq_categorias', array(
                'nombre' => trim( $_POST['nombre'] )
            ));

            Web::redirect('/admincp/faq/categorias/done/');
        }

        // $this->set($_POST);
    }
}