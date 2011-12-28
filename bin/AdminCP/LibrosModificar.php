<?php

include_once "$root/bin/AdminCP/Base.php";
include_once "$root/inc/search.php";

class AdminCP_LibrosModificar extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;
    protected $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];
        $this->done = ( $argv[1] == 'done' );

        if ( $this->id )
            $this->modify($this->id);
        else
            Web::redirect('/admincp/libros/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_libros'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'titulo'    => 'required',
            'anho'      => array( 'required' => true, 'number' => true ),
            'tomos'     => array( 'required' => true, 'number' => true ),
            'paginas'   => array( /* 'required' => true, */ 'number' => true ),
            'sinopsis'  => 'required',
            'precio'    => array( /* 'required' => true, */ 'number' => true )
        ));

        if ( $this->isValid() )
        {
            Db::update('libros', array(
                'isbn'    => $_POST['isbn'],
                'titulo'  => trim( $_POST['titulo'] ),
                'anho'    => $_POST['anho'],
                'tomos'   => $_POST['tomos'],
                'paginas' => $_POST['paginas'],
                'precio'  => $_POST['precio'],
                'fecha'   => time()
            ), "id_libros = '$id'");

            Db::update('libros_sinopsis', array(
                'sinopsis' => $_POST['sinopsis']
            ), "id_libros = '$id'");

            indexarLibro(
                $id, true, true, $this->isModulo(MODULOS_BUSCAR_SINONIMOS)
            );

            Web::redirect("/admincp/libros/$id/done/");
        }
    }

    public function modify( $id )
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

        if ( sizeof($result) == 0 )
            Web::redirect('/admincp/libros/error/');

        $libro = $result[0];

        if ( strlen($libro['coleccion']) == 0 )
            $libro['coleccion'] = '(sin colecci&oacute;n)';

        $this->title(
            array('Panel de Control', 'Libros', $libro['titulo'], 'Modificar')
        );

        $this->set($libro)
             ->end();

        if ( $this->isModulo(MODULOS_LIBROS_COLECCIONES) )
        {
            $this->block('ifColeccion')
                 ->set('tomoblockClass', ( $libro['tomos'] > 0 ) ? 'hidden' : '')
                 ->end();
        }

        $this->specialchars();
    }
}