<?php

include_once "$root/bin/BaseLoginAdmin.php";

class UsuariosCarrito extends BaseLoginAdmin
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        if ( $argv[1] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $idUsuarios = $argv[0];

        $result = Db::query(
            "SELECT usuarios.id_usuarios
                  , usuarios.nombre
                  , usuarios.ultimo
             FROM usuarios
             WHERE usuarios.id_usuarios = '$idUsuarios'"
        );

        $usuario = $result[0];

        $carrito = Db::query(
            "SELECT libros.id_libros
                  , carrito.id_carrito
                  , carrito.id_usuarios
                  , carrito.fecha
                  , libros.isbn
                  , libros.anho
                  , libros.tomos
                  , libros.titulo
                  , libros.paginas
                  , autores.nombre AS autor
                  , editoriales.nombre AS editorial
               FROM carrito
         INNER JOIN libros
                 ON libros.id_libros = carrito.id_libros
         INNER JOIN autores
                 ON autores.id_autores = libros.id_autores
         INNER JOIN editoriales
                 ON editoriales.id_editoriales = libros.id_editoriales
              WHERE carrito.id_usuarios = '{$idUsuarios}'"
        );

        foreach ( $carrito as $value )
        {
            $value['url']          = urlencode($value['id_libros'] . ' ' . $value['titulo']);
            $value['autorUri']     = buscarURI(array('autor' => $value['autor']));
            $value['editorialUri'] = buscarURI(array('editorial' => $value['editorial']));

            if ( is_file( $imagen = "upl/libros/{$value['id_libros']}/75x100/i.jpg" ) )
                $value['imagen'] = "/$imagen";

            if ( strlen($value['titulo']) > 65 )
                $value['titulo'] = substr($value['titulo'], 0, 65) . '...';

            $this->block('carrito')->set($value)->end();

            if ( $value['anho'] > 0 && $value['anho'] < 9999 )
                $this->block('carrito.anho')->end();

            if ( strlen($value['isbn']) > 0 )
                $this->block('carrito.isbn')->end();
                
            if ( $this->user->id == $idUsuarios || $this->user->admin )
                $this->block('carrito.del')->end();
        }

        $this->title(
            array('Usuarios', $usuario['nombre'], 'Lista de Deseos')
        );

        $this->set('id_usuarios', $idUsuarios);
        $this->set('nombre', $usuario['nombre']);

        if ( sizeof($carrito) == 0 )
            $this->block('empty')->end();
    }
}