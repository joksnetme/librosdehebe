<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Contacto extends AdminCP_Base
{
    public $type = 'text/html';

    protected $done = false;
    protected $error = false;

    protected $read = false;
    protected $unread = false;

    public function __construct( $argv = array() )
    {
        parent::__construct('Mensajes');

        $this->done = ( $argv[0] == 'done' );
        $this->error = ( $argv[0] == 'error' );

        $this->read = ( $argv[0] == 'read' );
        $this->unread = ( $argv[0] == 'unread' );

        if ( $this->read )
        {
            $where = 'WHERE contacto.leido = 1';
            $this->block('read')->end();
        }
        elseif ( $this->unread )
        {
            $where = 'WHERE contacto.leido = 0';
            $this->block('unread')->end();
        }
        else
            $where = '';

        $result = Db::query(
            "SELECT contacto.id_contacto
                  , contacto.id_usuarios
                  , contacto.nombre
                  , contacto.asunto
                  , contacto.fecha
             FROM contacto
             $where
             ORDER BY contacto.fecha DESC"
        );

        if ( $this->done )
            $this->block('validation')->end()
                 ->block('validation.done')->end();

        if ( $this->error )
            $this->block('validation')->end()
                 ->block('validation.error')->end();

        if ( ( $numRows = sizeof($result) ) > 0 )
        {
            $pos = 0;

            foreach ( $result as $row )
            {
                $pos++;

                $row['fecha'] = date('d/m/Y H:i', $row['fecha']);

                $this->block('each')
                     ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                     ->set('pos', $pos)
                     ->set('id', $row['id_contacto'])
                     ->set($row)
                     ->end();

                if ( $row['id_usuarios'] )
                {
                    $this->block('each.userLink')
                         ->set('id_usuarios', $row['id_usuarios'])
                         ->end();
                }
            }
        }
    }
}