<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_CondicionesAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct( array('Condiciones', 'Agregar') );
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'condicion' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::insert('condiciones', array(
                'nombre' => $_POST['condicion']
            ));

            Web::redirect("/admincp/condiciones/done/");
        }

        $this->set($_POST);
    }
}