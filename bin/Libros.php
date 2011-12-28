<?php

include_once "$root/bin/Base.php";

class Libros extends Base
{
    public $type = 'text/html';
    
    private $libro;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        list( $idLibros ) = explode( ' ', urldecode( $argv[0] ) );

        $libro = Db::query(
            "SELECT libros.id_libros
                  , libros.isbn
                  , libros.titulo
                  , libros.anho
                  , libros.tomos
                  , libros.paginas
                  , libros.precio
                  , libros_sinopsis.sinopsis
                  , autores.nombre     AS autor
                  , editoriales.nombre AS editorial
                  , colecciones.nombre AS coleccion
                  , categorias.nombre  AS categoria
                  , idiomas.nombre     AS idioma
                  , IF(NOT(ISNULL(deseos.id_deseos)), 1, 0) AS isDeseo
               FROM libros
         INNER JOIN autores
                 ON autores.id_autores = libros.id_autores
         INNER JOIN editoriales
                 ON editoriales.id_editoriales = libros.id_editoriales
          LEFT JOIN colecciones
                 ON colecciones.id_colecciones = libros.id_colecciones
          LEFT JOIN categorias
                 ON categorias.id_categorias = libros.id_categorias
          LEFT JOIN libros_sinopsis
                 ON libros_sinopsis.id_libros = libros.id_libros
         INNER JOIN idiomas
                 ON idiomas.id_idiomas = libros.id_idiomas
          LEFT JOIN deseos
                 ON deseos.id_libros = libros.id_libros
                AND deseos.id_usuarios = '{$this->user->id}'
              WHERE libros.id_libros = '$idLibros'"
        );

        $libro = $libro[0];

        $libro['autorUri']     = buscarURI(array('autor' => $libro['autor']));
        $libro['editorialUri'] = buscarURI(array('editorial' => $libro['editorial']));
        $libro['coleccionUri'] = buscarURI(array('keywords' => $libro['coleccion']));

        if ( is_file( $imagen = "upl/libros/$idLibros/250x330/i.jpg" ) )
            $libro['imagen'] = "/$imagen";

        $libro['imagenGrande'] = "/upl/libros/$idLibros/i.jpg";

        $libro['sinopsis'] = textFormat($libro['sinopsis']);

        $this->set($libro)
             ->set('id_libros', $idLibros);

        if ( $this->isModulo(MODULOS_LIBROS_OFERTAR) )
            $this->block('ofertar')->end();
        else
            $this->block('fijo')->end();

        if ( $libro['anho'] > 0 && $libro['anho'] < 9999 )
            $this->block('anho')->end();

        if ( strlen($libro['isbn']) > 0 )
            $this->block('isbn')->end();

        if ( strlen($libro['coleccion']) > 0 && $this->isModulo(MODULOS_LIBROS_COLECCIONES) )
            $this->block('coleccion')->end();

        if ( $libro['isDeseo'] == 0 && $this->user->login )
            $this->block('deseo')->end();

        $this->title( array( 'Libros', $libro['titulo'] ) );

        if ( $this->user->login ){
            $this->set('id_usuarios', $this->user->id);
            $this->set('nombre', $this->user->data['nombre']);
            $this->set('correo', $this->user->data['correo']);
        }
            
        $i = 0;
        while( is_file( "upl/libros/$idLibros/250x330/" . ( $roman = toRoman(++$i) ) . ".jpg" ) ){
            $this->block('romanos')->set(array(
                'numero' => strtoupper($roman),
                'class'  => $i == 1 ? 'selected' : ''
            ))->end();
        }
        
        $this->set('uri', $_SERVER['REQUEST_URI']);
        
        $this->libro = $libro;
    }
    
    public function __onSubmit(){
        
        if ( isset($_POST['comentar']) )
            $this->comentar();
    }
    
    private function comentar(){
    
        global $root;
        
        include_once $root . '/inc/DefinedMail.php';
    
        $this->validation(array(
            'tunombre' => 'required',
            'tucorreo' => 'required',
            'sunombre' => 'required',
            'sucorreo' => 'required'
        ));
    
        if ( $this->isValid() ){

            $tunombre = $_POST['tunombre'];
            $tucorreo = $_POST['tucorreo'];
            $sunombre = $_POST['sunombre'];
            $sucorreo = $_POST['sucorreo'];
            $mensaje  = $_POST['mensaje'];
            
            Db::insert('amigos', array(
                'id_libros'   => $this->libro['id_libros'],
                'id_usuarios' => $this->user->login ? $this->user->id : 0,
                'tunombre'    => $tunombre,
                'tucorreo'    => $tucorreo,
                'sunombre'    => $sunombre,
                'sucorreo'    => $sucorreo,
                'mensaje'     => $mensaje,
                'fecha'       => time()
            ));

            DefinedMail::from('info@joksnet.com.ar', 'Libros de Hebe');

            $mensaje = "$tunombre te recomienda que leas {$this->libro['titulo']}\n
            Para verlo, visita http://librosdehebe.com.ar{$_SERVER['REQUEST_URI']}.\n
            Mensaje de $tunombre: \"$mensaje\"";

            DefinedMail::mail("$tunombre te recomienda un libro")
              ->to($sucorreo, $sunombre)
              ->html($mensaje)
              ->send();        

            header("Location: {$_SERVER['REQUEST_URI']}");
        }
    }
}