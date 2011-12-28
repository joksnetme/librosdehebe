<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_PaisesModificar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Paises');
        
        $this->id_paises = intval($argv[0]);
        
        $pais = Db::query(
            "SELECT paises.id_paises
                  , paises.pais
                  , paises.abbr
                  , paises.codigo
               FROM paises
              WHERE paises.id_paises = '$this->id_paises'"
        );
        
        $this->set('Pais', $pais[0]['pais']);
        $this->set($pais[0]);
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
            Db::update('paises', array(
                'pais' => $_POST['pais'],
                'abbr' => $_POST['abbr'],
                'codigo' => $_POST['codigo']
            ), "id_paises = '$this->id_paises'");
            
            Web::redirect("/admincp/paises/done/");
        }
        
        $this->set($_POST);
    }
}