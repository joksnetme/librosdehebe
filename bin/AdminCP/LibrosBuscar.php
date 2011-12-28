<?php

include_once "$root/bin/AdminCP/Base.php";
include_once "$root/inc/search.php";

class AdminCP_LibrosBuscar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct(array('Libros', 'B&uacute;squeda'));

        if ( isset($argv[0]) )
            $this->search($argv[0]);
        else
            Web::redirect('/admincp/libros/error/');
    }

    public function search( $query )
    {
        global $root;

        $where = '';
        $orderBy = 'libros.titulo';

        $sinprecios = false;
        $sintapas = false;
        $sinanho = false;
        $sincoleccion = false;

        $this->set('query', $query);
        $query = urldecode($query);
        $this->set('text', $query);

        if ( $query == 'all' ) { }
        elseif ( $query == 'allbyid' )
        {
            $orderBy = 'libros.id_libros';
        }
        elseif ( $query == 'sinprecios' )
        {
            $where = "WHERE libros.precio = 0";
            $sinprecios = true;
        }
        elseif ( $query == 'sintapas' )
            $sintapas = true;
        elseif ( $query == 'sinanho' )
        {
            $where = "WHERE ( libros.anho = 0 OR libros.anho = 9999 )";
            $sinanho = true;
        }
        elseif ( $query == 'sincoleccion' )
        {
            $where = "WHERE isNULL(colecciones.id_colecciones)";
            $sincoleccion = true;
        }
        else
        {
            $searchIds = search(
                array( 'keywords' => $query ), 3, $this->isModulo(MODULOS_BUSCAR_SINONIMOS)
            );

            if ( false === $searchIds )
                Web::redirect('/admincp/libros/error/');

            $where = "WHERE libros.id_libros IN ( " . implode(', ', $searchIds) . " )";

            /**
            $query = str_replace('+', '%', $query);
            $query = str_replace(' ', '%', $query);
            $query = strtolower("%$query%");

            $where = "WHERE LCASE(libros.isbn) LIKE '$query'
                OR LCASE(libros.titulo) LIKE '$query'
                OR LCASE(libros.anho) LIKE '$query'
                OR LCASE(autores.nombre) LIKE '$query'
                OR LCASE(editoriales.nombre) LIKE '$query'";
             */
        }

        unset($_SESSION['SQL']);

        $sql = "SELECT libros.id_libros
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
                 LEFT JOIN colecciones
                        ON colecciones.id_colecciones = libros.id_colecciones
                $where
                ORDER BY $orderBy";

        $result = Db::query($sql);

        if ( ( $numRows = sizeof($result) ) > 0 )
        {
            if ( $numRows == 1 )
                Web::redirect("/admincp/libros/{$result[0]['id_libros']}/");

            /**
             * Guardo la SQL para que despues desde LibrosVer se pueda generar
             * el Anterior/Siguiente con el mismo orden de la busqueda.
             */
            $_SESSION['SQL'] = $sql;

            $pos = 0;
            $precio = 0;

            foreach ( $result as $row )
            {
                if ( $sintapas && is_readable("$root/upl/libros/{$row['id_libros']}/i.jpg") )
                    continue;

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

            if ( $pos == 0 )
                Web::redirect('/admincp/libros/error/');

            $this->set('precio', number_format($precio, 2));
        }
        else
            Web::redirect('/admincp/libros/error/');
    }
}