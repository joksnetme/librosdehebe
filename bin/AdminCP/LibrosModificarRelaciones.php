<?php

include_once "$root/bin/AdminCP/Base.php";
include_once "$root/inc/search.php";

class AdminCP_LibrosModificarRelaciones extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;
    protected $relacion = '';
    protected $tabla = '';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $relaciones = array(
            'autor'     => 'autores',
            'editorial' => 'editoriales',
            'coleccion' => 'colecciones'
        );

        $this->id = $argv[0];
        $this->relacion = $argv[1];

        if ( $this->id && isset($relaciones[$this->relacion]) )
        {
            $this->tabla = $relaciones[$this->relacion];
            $this->modify($this->id, $relaciones[$this->relacion]);
        }
        else
            Web::redirect('/admincp/libros/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_libros'];

        if ( !( $id ) || $id != $this->id )
            return;

        if ( $_POST['relacion'] == 'new' )
            $idRelacion = Db::insert($this->tabla, array( 'nombre' => $_POST['relacionNombre'] ));
        else
            $idRelacion = $_POST['relacion'];

        Db::update('libros', array(
            "id_{$this->tabla}" => $idRelacion
        ), "id_libros = '$id'");

        indexarLibro(
            $id, true, true, $this->isModulo(MODULOS_BUSCAR_SINONIMOS)
        );

        Web::redirect("/admincp/libros/$id/done/");
    }

    public function modify( $id, $tabla )
    {
        $nombres = array( 'autores' => 'Autor', 'editoriales' => 'Editorial', 'colecciones' => 'Colecci&oacute;n' );
        $nombresPrural = array( 'autores' => 'Autores', 'editoriales' => 'Editoriales', 'colecciones' => 'Colecciones' );

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

        $this->set('relacionUri', $this->relacion)
             ->set('relacionNombre', $nombres[$tabla])
             ->set('relacionNombrePrural', $nombresPrural[$tabla])
             ->set($libro)
             ->end();

        $this->title(
            array('Panel de Control', 'Libros', $libro['titulo'], 'Modificar', $nombres[$tabla])
        );

        $relaciones = Db::query(
            "SELECT r.id_$tabla AS id
                  , r.nombre
             FROM $tabla r
             ORDER BY r.nombre"
        );

        if ( $relaciones )
        {
            $this->block('relaciones')->end();

            foreach ( $relaciones as $relacion )
            {
                $this->block('relaciones.relacion')
                     ->set('value', $relacion['id'])
                     ->set('name', $relacion['nombre'])
                     ->end();

                if ( $relacion['id'] == $libro["id_$tabla"] )
                    $this->block('relaciones.relacion.checked')->end();
            }
        }
    }
}