<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_EditorialesVer extends AdminCP_Base
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
        {
            $this->view($this->id);
            $this->search($this->id);
            $this->editoriales($this->id);
        }
        else
            Web::redirect('/admincp/editoriales/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_editoriales'];

        if ( !( $id ) || $id != $this->id )
            return;

        if ( isset($_POST['change']) )
        {
            $id_new = (int) $_POST['new'];

            /**
             *
            $result = Db::query(
                "SELECT libros.id_libros
                 FROM libros
                 WHERE libros.id_editoriales = '$id'"
            );

            foreach ( $result as $row )
            {
                Db::update('libros', array(
                    'id_editoriales' => $id_new
                ), "id_libros = '{$row['id_libros']}'");
            }
             *
             */

            Db::update('libros', array( 'id_editoriales' => $id_new ), "id_editoriales = '$id'");
            Db::delete('editoriales', "id_editoriales = '$id'");
        }

        Web::redirect("/admincp/editoriales/done/");
    }

    public function view( $id )
    {
        if ( $this->done )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $result = Db::query(
            "SELECT editoriales.id_editoriales
                  , editoriales.nombre
             FROM editoriales
             WHERE editoriales.id_editoriales = '$id'"
        );

        $editorial = $result[0];

        $this->title(
            array('Panel de Control', 'Editoriales', $editorial['nombre'])
        );

        $this->set($editorial)
             ->end();
    }

    public function search( $id )
    {
        $result = Db::query(
            "SELECT libros.id_libros
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
             FROM libros
             INNER JOIN autores
                     ON autores.id_autores = libros.id_autores
             INNER JOIN editoriales
                     ON editoriales.id_editoriales = libros.id_editoriales
                    AND editoriales.id_editoriales = '$id'
             ORDER BY libros.titulo"
        );

        if ( ( $numRows = sizeof($result) ) > 0 )
        {
            $pos = 0;
            $precio = 0;

            foreach ( $result as $row )
            {
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

            $this->set('precio', number_format($precio, 2));
        }
    }

    public function editoriales( $id )
    {
        $result = Db::query(
            "SELECT editoriales.id_editoriales
                  , editoriales.nombre
             FROM editoriales
             ORDER BY editoriales.nombre"
        );

        foreach ( $result as $row )
        {
            if ( $row['id_editoriales'] == $id )
                continue;

            $this->block('editoriales')
                 ->set($row)->end();
        }
    }
}