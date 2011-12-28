<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_PaisesAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Paises');
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'pais'   => 'required',
            'abbr'   => 'required',
            'codigo' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::insert('paises', array(
                'pais' => $_POST['pais'],
                'abbr' => $_POST['abbr'],
                'codigo' => $_POST['codigo']
            ));
            
            Web::redirect("/admincp/paises/done/");
        }
        
        $this->set($_POST);
    }
}