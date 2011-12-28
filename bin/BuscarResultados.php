<?php

include_once "$root/bin/Base.php";
include_once "$root/inc/search.php";

class BuscarResultados extends Base
{
    public $type = 'text/html';

    protected $encoding = 'utf-8';
    protected $minChars = 3;

    protected $values = array();
    protected $result = array();

    public function __construct( $argv = array() )
    {
        parent::__construct(
            array('Buscar', 'Resultados')
        );

        $this->nav('Buscar');

        $this->values = $this->parseUri($argv);
        $this->result = search(
            $this->values, $this->minChars, $this->isModulo(MODULOS_BUSCAR_SINONIMOS)
        );

        if ( false === $this->result )
            Web::redirect("/buscar/error/");

        if ( $this->isModulo(MODULOS_BUSCAR_JAVASCRIPT) )
            $this->showJS();
        else
            $this->show();
    }

    protected function parseUri( $argv )
    {
        $fields = array( 'titulo', 'autor', 'anho', 'editorial', 'keywords' );
        $values = array();

        $parts = explode('/', $argv[0]);
        $partI = 0;

        foreach ( $parts as $part )
        {
            $i = 0;

            while ( substr($part, $i, 1) == '+' )
            {
                $i++;
                $partI++;
            }

            $values[$fields[$partI]] = urldecode( substr($part, $i) );
            $partI++;
        }

        return $values;
    }

    protected function showJS()
    {
        if ( !( $this->result ) || sizeof($this->result) == 0 )
            Web::redirect("/buscar/error/");

        $ids = implode(', ', $this->result);
        $result = Db::query(
            "SELECT libros.id_libros
                  , libros.isbn
                  , libros.titulo
                  , libros.anho
                  , libros.tomos
                  , libros.paginas
                  , libros.precio
#                 , libros_sinopsis.sinopsis
                  , libros.fecha
                  , autores.id_autores
                  , autores.nombre AS autor
                  , editoriales.id_editoriales
                  , editoriales.nombre AS editorial
                  , idiomas.id_idiomas
                  , idiomas.nombre AS idioma
             FROM libros
             INNER JOIN autores
                     ON autores.id_autores = libros.id_autores
             INNER JOIN editoriales
                     ON editoriales.id_editoriales = libros.id_editoriales
             INNER JOIN idiomas
                     ON idiomas.id_idiomas = libros.id_idiomas
#             LEFT JOIN libros_sinopsis
#                    ON libros_sinopsis.id_libros = libros.id_libros
             WHERE libros.id_libros IN ( $ids )"
        );

        if ( !( $result ) )
            Web::redirect("/buscar/error/");

        $first = true;

        foreach ( $result as $row )
        {
            if ( $first )
            {
                // $class = 'active';
                $class = '';
                $first = false;
            }
            else
                $class = '';

            $idLibros = $row['id_libros'];

            if ( $row['tomos'] > 1 )
                $row['s'] = 's';

            $row['autorUri'] = '/buscar/+' . trim( urlencode($row['autor']) ) . '/';
            $row['editorialUri'] = '/buscar/+++' . trim( urlencode($row['editorial']) ) . '/';
            $row['url'] = trim( urlencode( $row['titulo'] ) );

            $this->block('each')
                 ->set($row)
                 ->set('class', $class)
                 ->end();

            if ( $row['anho'] != 9999 && $row['anho'] != 0 )
                $this->block('each.anho')->end();

            if ( strlen($row['isbn']) > 0 )
                $this->block('each.isbn')->end();
        }

        # search nav
        foreach ( $this->values as $key => $value )
        {
            $other = array_filter($this->values, create_function('$v', 'return $v != "' . addslashes($value) . '";'));

            $this->block('searchNav')->set(array(
                'other' => buscarURI($other),
                'uri'   => buscarURI(array($key => $value)),
                'value' => $value
            ))->end();

            $this->block('buscado')->set(array(
                'key' => $key,
                'value' => $value
            ))->end();
        }

        $fields = array( 'titulo', 'autor', 'anho', 'editorial', 'keywords' );
        $names  = array( 'T&iacute;tulo', 'Autor', 'A&ntilde;o', 'Editorial', 'Palabras Clave' );

        $found = false;

        foreach ( $fields as $i => $key )
        {
            if ( !( array_key_exists($key, $this->values) ) )
            {
                if ( !( $found ) )
                {
                    $this->block('try')->end();
                    $found = true;
                }

                $this->block('try.keys')->set(array(
                    'id' => $key,
                    'name' => $names[$i]
                ))->end();
            }
        }

        if ( $found )
        {
            $this->block(
                $this->isModulo(MODULOS_BUSCAR_RANGOANHO) ? 'try.buscar_rangoanho' : 'try.no_buscar_rangoanho'
            )->end();
        }

        $this->set($this->values);
    }

    protected function show()
    {
        //
    }
}