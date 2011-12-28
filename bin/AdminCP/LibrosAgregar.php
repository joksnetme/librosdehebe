<?php

include_once "$root/bin/AdminCP/Base.php";
include_once "$root/inc/search.php";

class AdminCP_LibrosAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    // protected $categorias = array();
    protected $idiomas = array();

    protected $autores     = false;
    protected $editoriales = false;
    protected $colecciones = false;
    protected $libreria    = false;
    protected $librerias   = array();

    protected $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct(array('Libros', 'Agregar'));

        // $this->categorias = Db::query('SELECT id_categorias, nombre FROM categorias ORDER by nombre');
        $this->idiomas = Db::query('SELECT id_idiomas, abbr, nombre FROM idiomas ORDER by nombre');
        $this->done = ( $argv[0] == 'done' );
        
        
        if ( $this->user->data['id_librerias'] > 0 )
        {
            $libreria = Db::query(
                "SELECT nombre FROM librerias WHERE id_librerias = '{$this->user->data['id_librerias']}'"
            );
            
            $this->libreria = $libreria[0]['nombre'];
        }
        else
        {
            $this->librerias = Db::query(
                "SELECT librerias.id_librerias
                      , librerias.nombre AS libreria
                   FROM librerias"
            );
        }
    }

    public function __onSubmit()
    {
        /**
        if ( isset($_POST['catagregar']) )
        {
            $this->validation(array(
                'catnombre' => 'required'
            ));

            if ( $this->isValid() )
            {
                Db::insert('categorias', array(
                    'nombre' => $_POST['catnombre']
                ));

                $this->categorias = Db::query(
                    'SELECT id_categorias, nombre
                     FROM categorias
                     ORDER by nombre'
                );
            }
        }
        else
         */
        if ( isset($_POST['save']) )
        {
            $this->validation(array(
                'titulo'    => 'required',
                'autor'     => 'required',
                'anho'      => array( 'required' => true, 'number' => true ),
                'editorial' => 'required',
                // 'categoria' => 'required',
                'tomos'     => array( 'required' => true, 'number' => true ),
                'paginas'   => array( /* 'required' => true, */ 'number' => true ),
                'ejemplares' => array( /* 'required' => true, */ 'number' => true ),
                'sinopsis'  => 'required',
                'precio'    => array( /* 'required' => true, */ 'number' => true )
            ));

            if ( $this->isValid() )
            {
                $this->autores = Db::query(
                    'SELECT id_autores, nombre
                     FROM autores
                     WHERE LCASE(nombre) LIKE "%' . strtolower($_POST['autor']) . '%"
                     ORDER BY nombre'
                );

                $this->editoriales = Db::query(
                    'SELECT id_editoriales, nombre
                     FROM editoriales
                     WHERE LCASE(nombre) LIKE "%' . strtolower($_POST['editorial']) . '%"
                     ORDER BY nombre'
                );

                if ( strlen($_POST['coleccion']) > 0 )
                {
                    $this->colecciones = Db::query(
                        'SELECT id_colecciones, nombre
                         FROM colecciones
                         WHERE LCASE(nombre) LIKE "%' . strtolower($_POST['coleccion']) . '%"
                         ORDER BY nombre'
                    );
                }

                if ( $this->autores && sizeof($this->autores) === 1
                  && $this->editoriales && sizeof($this->editoriales) === 1 )
                {
                    $add = true;
                    $idColecciones = 0;

                    if ( $this->colecciones )
                    {
                        if ( sizeof($this->colecciones) == 1 )
                            $idColecciones = $this->colecciones[0]['id_colecciones'];
                        else
                            $add = false;
                    }

                    if ( $add )
                    {
                        $this->saveLibro(
                            $this->autores[0]['id_autores'],
                            $this->editoriales[0]['id_editoriales'],
                            $idColecciones
                        );

                        Web::redirect('/admincp/libros/agregar/done/');
                    }
                }
            }
        }
        elseif ( isset($_POST['save2']) )
        {
            if ( $_POST['autor'] == 'new' )
                $idAutores = Db::insert('autores', array( 'nombre' => $_POST['autorNombre'] ));
            else
                $idAutores = $_POST['autor'];

            if ( $_POST['editorial'] == 'new' )
                $idEditoriales = Db::insert('editoriales', array( 'nombre' => $_POST['editorialNombre'] ));
            else
                $idEditoriales = $_POST['editorial'];

            if ( isset($_POST['coleccion']) )
            {
                if ( $_POST['coleccion'] == 'new' )
                    $idColecciones = Db::insert('colecciones', array( 'nombre' => $_POST['coleccionNombre'] ));
                else
                    $idColecciones = $_POST['coleccion'];
            }
            else
                $idColecciones = 0;

            $this->saveLibro(
                $idAutores, $idEditoriales, $idColecciones
            );

            Web::redirect('/admincp/libros/agregar/done/');
        }
    }

    protected function saveLibro( $idAutores, $idEditoriales, $idColecciones = 0 )
    {
        $idIdiomas = 0;

        foreach ( $this->idiomas as $idioma )
        {
            if ( $idioma['abbr'] == $_POST['idioma'] )
            {
                $idIdiomas = $idioma['id_idiomas']; break;
            }
        }

        if ( $idIdiomas == 0 )
        {
            $idioma = Db::query(
                'SELECT id_idiomas
                 FROM idiomas
                 WHERE abbr = "' . $_POST['idioma'] . '"'
            );

            $idIdiomas = $idioma[0]['id_idiomas'];
        }

        $idLibros = Db::insert('libros', array(
            'id_autores'     => $idAutores,
            'id_editoriales' => $idEditoriales,
            'id_colecciones' => $idColecciones,
            // 'id_categorias'  => $_POST['categoria'],
            'id_idiomas'     => $idIdiomas,
            'isbn'           => $_POST['isbn'],
            'titulo'         => trim( $_POST['titulo'] ),
            'anho'           => $_POST['anho'],
            'tomos'          => $_POST['tomos'],
            'paginas'        => $_POST['paginas'],
            'precio'         => $_POST['precio'],
            'fecha'          => time()
        ));

        $sinopsis = trim( $_POST['sinopsis'] );

        // if ( strlen($sinopsis) > 0 )
        {
            Db::insert('libros_sinopsis', array(
                'id_libros' => $idLibros,
                'sinopsis'  => $sinopsis
            ));
        }

        indexarLibro(
            $idLibros, true, true, $this->isModulo(MODULOS_BUSCAR_SINONIMOS)
        );
        
        if ( $this->isModulo(MODULOS_LIBROS_CANTIDADES) && isset($_POST['ejemplares']) && $_POST['ejemplares'] > 0 )
        {
            if ( isset($_POST['libreria']) )
            {
                $this->user->data['id_librerias'] = intval($_POST['libreria']);
                
                Db::update('usuarios', array(
                    'id_librerias' => $this->user->data['id_librerias'],
                ), "id_usuarios = '{$this->user->id}'");
            }
            
            Db::insert('librerias_stock', array(
                'id_librerias' => $this->user->data['id_librerias'],
                'id_libros'    => $idLibros,
                'cantidad'     => intval($_POST['ejemplares'])
            ));
        }

        return $idLibros;
    }

    public function __toString()
    {
        if ( $this->autores !== false || $this->editoriales !== false )
        {
            $this->block('try')
                 ->set($_POST)
                 ->set('sinopsis', stripslashes( $_POST['sinopsis'] ))
                 ->end();

            if ( $this->autores && sizeof($this->autores) > 0 )
            {
                $this->block('try.autores')->end();

                foreach ( $this->autores as $autor )
                {
                    $this->block('try.autores.autor')
                         ->set('value', $autor['id_autores'])
                         ->set('name', $autor['nombre'])
                         ->end();
                }
            }

            if ( $this->editoriales && sizeof($this->editoriales) > 0 )
            {
                $this->block('try.editoriales')->end();

                foreach ( $this->editoriales as $editorial )
                {
                    $this->block('try.editoriales.editorial')
                         ->set('value', $editorial['id_editoriales'])
                         ->set('name', $editorial['nombre'])
                         ->end();
                }
            }

            $if = !( $this->autores && $this->editoriales );

            if ( strlen($_POST['coleccion']) > 0 )
            {
                $this->block('try.ifColeccion')->end();

                if ( $this->colecciones && sizeof($this->colecciones) > 0 )
                {
                    $this->block('try.colecciones')->end();

                    foreach ( $this->colecciones as $coleccion )
                    {
                        $this->block('try.colecciones.coleccion')
                             ->set('value', $coleccion['id_colecciones'])
                             ->set('name', $coleccion['nombre'])
                             ->end();
                    }
                }

                $if = $if || !( $this->colecciones );
            }

            if ( $if )
            {
                $this->block('validation')->end();

                if ( !( $this->autores ) )
                {
                    $this->block('validation.autor_zeroresult')
                         ->set('value', $_POST['autor'])
                         ->end();
                }

                if ( !( $this->editoriales ) )
                {
                    $this->block('validation.editorial_zeroresult')
                         ->set('value', $_POST['editorial'])
                         ->end();
                }

                if ( strlen($_POST['coleccion']) > 0 )
                {
                    if ( !( $this->colecciones ) )
                    {
                        $this->block('validation.coleccion_zeroresult')
                             ->set('value', $_POST['coleccion'])
                             ->end();
                    }
                }
            }
        }
        else
        {
            if ( $this->done )
            {
                $this->block('validation')->end()
                     ->block('validation.done')->end();
            }

            $this->block('main')->end();

            if ( sizeof($_POST) > 0 )
                $this->set($_POST);
            else
                $this->set(array(
                    'tomos'      => 1,
                    'paginas'    => 0,
                    'ejemplares' => 1
                ));

            /**
            foreach ( $this->categorias as $categoria )
            {
                $this->block('main.categoria')
                     ->set('value', $categoria['id_categorias'])
                     ->set('name', $categoria['nombre'])
                     ->end();

                if ( $_POST['categoria'] == $categoria['id_categorias'] )
                    $this->block('main.categoria.checked')->end();
            }
             */

            $idiomaDefault = ( isset($_POST['idioma']) ) ? $_POST['idioma'] : 'es';

            foreach ( $this->idiomas as $idioma )
            {
                $this->block('main.idioma')
                     ->set('value', $idioma['abbr'])
                     ->set('name', $idioma['nombre'])
                     ->end();

                if ( $idiomaDefault == $idioma['abbr'] )
                    $this->block('main.idioma.checked')->end();
            }

            if ( $this->isModulo(MODULOS_LIBROS_COLECCIONES) )
                $this->block('main.ifColeccion')->end();

            if ( $this->isModulo(MODULOS_LIBROS_CANTIDADES) )
            {
                if ( $this->libreria )
                    $this->block('main.ejemplares')->set( array('libreria' => $this->libreria) )->end();
                elseif ( count($this->librerias) > 0 )
                {
                    $this->block('main.ejemplaresLibrerias')->end();
    
                    foreach ( $this->librerias as $libreria )
                        $this->block('main.ejemplaresLibrerias.options')->set($libreria)->end();
                }
            }

            $this->specialchars('main');
        }

        // Para el JavaScript
        if ( $this->isModulo(MODULOS_LIBROS_COLECCIONES) )
                $this->block('ifColeccion')->end();

        parent::__toString();
    }
}