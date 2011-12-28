<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_SinonimosAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct(
            array('Sin&oacute;nimos', 'Agregar')
        );
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'palabra'  => 'required',
            'sinonimo' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::insert('sinonimos', array(
                'palabra'  => trim( strtolower( $_POST['palabra'] ) ),
                'sinonimo' => trim( strtolower( $_POST['sinonimo'] ) )
            ));

            Web::redirect("/admincp/sinonimos/done/");
        }
    }
}