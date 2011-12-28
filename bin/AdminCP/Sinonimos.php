<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Sinonimos extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Sin&oacute;nimos');

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $result = Db::query(
            "SELECT sinonimos.id_sinonimos
                  , sinonimos.palabra
                  , sinonimos.sinonimo
             FROM sinonimos
             ORDER BY sinonimos.sinonimo"
        );

        if ( ( $numRows = sizeof($result) ) > 0 )
        {
            $pos = 0;

            foreach ( $result as $row )
            {
                $pos++;

                $this->block('each')
                     ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                     ->set('pos', $pos)
                     ->set('id', $row['id_sinonimos'])
                     ->set($row)
                     ->end();
            }
        }
    }
}