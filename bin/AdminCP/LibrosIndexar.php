<?php

include_once "$root/bin/AdminCP/Base.php";
include_once "$root/inc/search.php";

class AdminCP_LibrosIndexar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct(array('Libros', 'Indexar'));

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }
    }

    public function __onSubmit()
    {
        if ( isset($_POST['mode']) )
        {
            switch ( $_POST['mode'] )
            {
                case 'libros':
                    $mode = Search::MODE_LIBROS;
                    break;

                // case 'single':
                default:
                    $mode = Search::MODE_SINGLE;
                    break;
            }
        }
        else
            $mode = Search::MODE_SINGLE;

        $search = new Search(
            $mode, $this->isModulo(MODULOS_BUSCAR_SINONIMOS)
        );

        Db::query("TRUNCATE palabras");
        Db::query("TRUNCATE palabras_relaciones");

        $isbn = ( isset($_POST['isbn']) && $_POST['isbn'] == 1 ) ? ', libros.isbn' : '';
        $sinopsis = ( isset($_POST['sinopsis']) && $_POST['sinopsis'] == 1 ) ? ', libros_sinopsis.sinopsis' : '';

        $result = Db::query(
            "SELECT libros.id_libros
                  {$isbn}
                  , libros.titulo
                  , libros.anho
                  {$sinopsis}
                  , autores.nombre AS autor
                  , editoriales.nombre AS editorial
                  , colecciones.nombre AS coleccion
             FROM libros
             LEFT JOIN libros_sinopsis
                    ON libros_sinopsis.id_libros = libros.id_libros
             INNER JOIN autores
                     ON autores.id_autores = libros.id_autores
             INNER JOIN editoriales
                     ON editoriales.id_editoriales = libros.id_editoriales
              LEFT JOIN colecciones
                     ON colecciones.id_colecciones = libros.id_colecciones
             ORDER BY libros.id_libros"
        );

        if ( $result )
        {
            foreach ( $result as $row )
            {
                $idLibros = $row['id_libros']; unset($row['id_libros']);
                $search->add($idLibros, $row);
            }
        }

        Web::redirect('/admincp/libros/indexar/done/');
    }
}