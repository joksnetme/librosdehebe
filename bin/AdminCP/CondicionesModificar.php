<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_CondicionesModificar extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = intval($argv[0]);

        $condicion = Db::query(
            "SELECT condiciones.id_condiciones
                  , condiciones.nombre AS condicion
               FROM condiciones
              WHERE condiciones.id_condiciones = '$this->id'"
        );

        $this->set($condicion[0])
             ->title( array('Panel de Control', 'Condiciones', $condicion[0]['condicion'], 'Modificar') );
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_condiciones'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'condicion' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::update('condiciones', array(
                'nombre' => $_POST['condicion'],
            ), "id_condiciones = '$this->id'");

            Web::redirect("/admincp/condiciones/done/");
        }

        $this->set($_POST);
    }
}