<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_LibrosVer extends AdminCP_Base
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
            $this->view($this->id);
        else
            Web::redirect('/admincp/libros/error/');
    }

    public function view( $id )
    {
        if ( $this->done )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $result = Db::query(
            "SELECT libros.id_libros
                  , libros.isbn
                  , libros.titulo
                  , libros.anho
                  , libros.tomos
                  , libros.paginas
                  , libros.precio
                  , libros_sinopsis.sinopsis
                  , libros.fecha
                  , autores.id_autores
                  , autores.nombre AS autor
                  , editoriales.id_editoriales
                  , editoriales.nombre AS editorial
                  , idiomas.id_idiomas
                  , idiomas.nombre AS idioma
                  , colecciones.id_colecciones
                  , colecciones.nombre AS coleccion
             FROM libros
             INNER JOIN autores
                     ON autores.id_autores = libros.id_autores
             INNER JOIN editoriales
                     ON editoriales.id_editoriales = libros.id_editoriales
             INNER JOIN idiomas
                     ON idiomas.id_idiomas = libros.id_idiomas
              LEFT JOIN libros_sinopsis
                     ON libros_sinopsis.id_libros = libros.id_libros
              LEFT JOIN colecciones
                     ON colecciones.id_colecciones = libros.id_colecciones
             WHERE libros.id_libros = '$id'"
        );

        $libro = $result[0];

        if ( strlen($libro['isbn']) == 0 )
            $libro['isbn'] = '(sin ISBN)';

        if ( $this->isModulo(MODULOS_LIBROS_COLECCIONES) )
        {
            $this->block('ifColeccion')->end();

            if ( strlen($libro['coleccion']) == 0 )
                $this->block('ifColeccion.empty')->end();
            else
                $this->block('ifColeccion.full')->end();
        }

        $libro['sinopsis'] = textFormat($libro['sinopsis']);

        $this->title(
            array('Panel de Control', 'Libros', $libro['titulo'])
        );

        $this->set($libro)
             ->end();

        if ( isset($_SESSION['SQL']) )
        {
            $this->block('controls')
                 ->end();

            $result = Db::query($_SESSION['SQL']);

            $last = array();
            $next = false;

            foreach ( $result as $row )
            {
                if ( $next )
                {
                    $this->block('controls.next')
                         ->set($row)
                         ->end();

                     break;
                }

                if ( $row['id_libros'] == $libro['id_libros'] )
                {
                    if ( !( empty($last) ) )
                    {
                        $this->block('controls.prev')
                             ->set($last)
                             ->end();
                    }

                    $next = true;
                }

                $last = $row;
            }

            if ( !( $next ) )
            {
                $row = array_shift($result);

                $this->block('controls.next')
                     ->set($row)
                     ->end();
            }
        }
    }
}