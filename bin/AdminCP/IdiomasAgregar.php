<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_IdiomasAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Idiomas');
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'idioma' => 'required',
            'abbr'   => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::insert('idiomas', array(
                'nombre' => $_POST['idioma'],
                'abbr' => $_POST['abbr']
            ));
            
            Web::redirect("/admincp/idiomas/done/");
        }
        
        $this->set($_POST);
    }
}