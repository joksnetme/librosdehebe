<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_LibreriasAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct( array('Librerias', 'Agregar') );
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'nombre' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::insert('librerias', array(
                'nombre' => trim($_POST['nombre'])
            ));

            Web::redirect("/admincp/librerias/done/");
        }

        $this->set($_POST);
    }
}