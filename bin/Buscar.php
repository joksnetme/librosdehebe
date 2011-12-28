<?php

include_once "$root/bin/Base.php";

class Buscar extends Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Buscar');

        $this->nav('Buscar');
        $this->error = ( $argv[0] == 'error' );
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'titulo'    => array( 'minLength' => 3 ),
            'autor'     => array( 'minLength' => 3 ),
            'editorial' => array( 'minLength' => 3 ),
            'keywords'  => array( 'minLength' => 3 ),

            'anho'   => 'number',
            'anho_d' => 'number',
            'anho_h' => 'number'
        ));

        if ( $this->isValid() )
        {
            $uri = '';

            if ( $this->isModulo(MODULOS_BUSCAR_RANGOANHO) )
            {
                if ( strlen($_POST['anho_d']) > 0 && strlen($_POST['anho_h']) > 0 )
                    $_POST['anho'] = "{$_POST['anho_d']}a{$_POST['anho_h']}";
                elseif ( strlen($_POST['anho_d']) > 0  )
                    $_POST['anho'] = $_POST['anho_d'];
                elseif ( strlen($_POST['anho_h']) > 0  )
                    $_POST['anho'] = $_POST['anho_h'];
            }

            Web::redirect("/buscar/" . buscarURI($_POST));
        }

        $this->set($_POST);
    }

    public function __toString()
    {
        if ( $this->error )
            $this->block('not_found')->end();

        if ( $this->isModulo(MODULOS_BUSCAR_RANGOANHO) )
            $this->block('buscar_rangoanho')->end();
        else
            $this->block('no_buscar_rangoanho')->end();

        parent::__toString();
    }
}