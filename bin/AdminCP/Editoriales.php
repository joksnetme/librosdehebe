<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Editoriales extends AdminCP_Base
{
    public $type = 'text/html';

    protected $done = false;
    protected $error = false;

    public function __construct( $argv = array() )
    {
        parent::__construct('Editoriales');

        $this->done = ( $argv[0] == 'done' );
        $this->error = ( $argv[0] == 'error' );

        $result = Db::query(
            "SELECT editoriales.id_editoriales
                  , editoriales.nombre
                  , COUNT(libros.id_libros) AS libros
                  , SUM(libros.precio) AS precio
             FROM editoriales
             LEFT JOIN libros
                    ON libros.id_editoriales = editoriales.id_editoriales
             GROUP BY editoriales.id_editoriales
             ORDER BY editoriales.nombre"
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
            $precio = 0;

            foreach ( $result as $row )
            {
                $pos++;
                $precio += $row['precio'];

                $row['precio'] = number_format($row['precio'], 2);

                $this->block('each')
                     ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                     ->set('pos', $pos)
                     ->set('id', $row['id_editoriales'])
                     ->set($row)
                     ->end();
            }

            $this->set('precio', number_format($precio, 2));
        }
    }
}