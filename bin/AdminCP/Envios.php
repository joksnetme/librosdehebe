<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Envios extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Formas de Env&iacute;o');

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $envios = Db::query(
            "SELECT envios.id_envios
                  , envios.nombre
                  , IF(envios.local = 1, 'S&iacute;', 'No') AS local
                  , envios.cantidad_tipo
                  , envios.cantidad
                  , envios.entrega
                  , envios.precio
               FROM envios"
        );

        $tipos = array(
            '=' => 'igual a',
            '<' => 'menor a',
            '>' => 'mayor a'
        );

        $i = 0;

        foreach ( $envios as $envio )
        {
            $envio['cantidad'] = $tipos[ $envio['cantidad_tipo'] ] . ' ' . $envio['cantidad'];
            $envio['pos'] = ++$i;

            $this->block('each')
                 ->set('class', ( $i % 2 == 0 ) ? 'even' : 'odd')
                 ->set($envio)
                 ->end();
        }

    }
}