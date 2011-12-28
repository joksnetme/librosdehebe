<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_IdiomasModificar extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;
    
    public function __construct( $argv = array() )
    {
        parent::__construct('Idiomas');
        
        $this->id = intval($argv[0]);
        
        $idioma = Db::query(
            "SELECT idiomas.id_idiomas
                  , idiomas.nombre AS idioma
                  , idiomas.abbr
               FROM idiomas
              WHERE idiomas.id_idiomas = '$this->id'"
        );

        $this->set($idioma[0]);
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_idiomas'];

        if ( !( $id ) || $id != $this->id )
            return;
            
        $this->validation(array(
            'idioma' => 'required',
            'abbr'   => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::update('idiomas', array(
                'nombre' => $_POST['idioma'],
                'abbr' => $_POST['abbr']
            ), "id_idiomas = '$this->id'");
            
            Web::redirect("/admincp/idiomas/done/");
        }
        
        $this->set($_POST);
    }
}