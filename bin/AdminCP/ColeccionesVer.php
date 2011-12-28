<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_ColeccionesVer extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;
    protected $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];
        $this->done = ( $argv[1] == 'done' );

        if ( $this->id && is_numeric($this->id) )
        {
            $this->view($this->id);
            $this->search($this->id);
        }
        else
            Web::redirect('/admincp/colecciones/error/');
    }

    public function view( $id )
    {
        if ( $this->done )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $result = Db::query(
            "SELECT colecciones.id_colecciones
                  , colecciones.nombre
             FROM colecciones
             WHERE colecciones.id_colecciones = '$id'"
        );

        $coleccion = $result[0];

        $this->title(
            array('Panel de Control', 'Colecciones', $coleccion['nombre'])
        );

        $this->set($coleccion)
             ->end();
    }

    public function search( $id )
    {
        $result = Db::query(
            "SELECT libros.id_libros
                  , libros.isbn
                  , libros.titulo
                  , libros.anho
                  , libros.tomos
                  , libros.paginas
                  , libros.precio
                  , libros.fecha
                  , autores.id_autores
                  , autores.nombre AS autor
                  , editoriales.id_editoriales
                  , editoriales.nombre AS editorial
                  , colecciones.id_colecciones
                  , colecciones.nombre AS coleccion
             FROM libros
             INNER JOIN autores
                     ON autores.id_autores = libros.id_autores
             INNER JOIN editoriales
                     ON editoriales.id_editoriales = libros.id_editoriales
             INNER JOIN colecciones
                     ON colecciones.id_colecciones = libros.id_colecciones
                    AND colecciones.id_colecciones = '$id'
             ORDER BY libros.titulo"
        );

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
                     ->set('id', $row['id_libros'])
                     ->set($row)
                     ->end();
            }

            $this->set('precio', number_format($precio, 2));
        }
    }
}