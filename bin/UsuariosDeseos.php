<?php

include_once "$root/bin/Base.php";

class UsuariosDeseos extends Base
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

        $deseos = Db::query(
            "SELECT libros.id_libros
                  , deseos.id_deseos
                  , deseos.id_usuarios
                  , deseos.fecha
                  , libros.isbn
                  , libros.anho
                  , libros.tomos
                  , libros.titulo
                  , libros.paginas
                  , autores.nombre AS autor
                  , editoriales.nombre AS editorial
               FROM deseos
         INNER JOIN libros
                 ON libros.id_libros = deseos.id_libros
         INNER JOIN autores
                 ON autores.id_autores = libros.id_autores
         INNER JOIN editoriales
                 ON editoriales.id_editoriales = libros.id_editoriales
              WHERE deseos.id_usuarios = '{$idUsuarios}'"
        );

        foreach ( $deseos as $value )
        {
            $value['url']          = urlencode($value['id_libros'] . ' ' . $value['titulo']);
            $value['autorUri']     = buscarURI(array('autor' => $value['autor']));
            $value['editorialUri'] = buscarURI(array('editorial' => $value['editorial']));

            if ( is_file( $imagen = "upl/libros/{$value['id_libros']}/75x100/i.jpg" ) )
                $value['imagen'] = "/$imagen";

            if ( strlen($value['titulo']) > 65 )
                $value['titulo'] = substr($value['titulo'], 0, 65) . '...';

            $this->block('deseos')->set($value)->end();

            if ( $value['anho'] > 0 && $value['anho'] < 9999 )
                $this->block('deseos.anho')->end();

            if ( strlen($value['isbn']) > 0 )
                $this->block('deseos.isbn')->end();
                
            if ( $this->user->id == $idUsuarios || $this->user->admin )
                $this->block('deseos.del')->end();
        }

        $this->title(
            array('Usuarios', $usuario['nombre'], 'Lista de Deseos')
        );

        $this->set('id_usuarios', $idUsuarios);
        $this->set('nombre', $usuario['nombre']);

        if ( sizeof($deseos) == 0 )
            $this->block('empty')->end();
    }
}