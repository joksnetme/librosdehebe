<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Modulos extends AdminCP_Base
{
    public $type = 'text/html';

    protected $modulos = array(
        MODULOS_BUSCAR_JAVASCRIPT,
        MODULOS_BUSCAR_SINONIMOS,
        MODULOS_BUSCAR_RANGOANHO,
        MODULOS_SPECIALCHARS,
        MODULOS_LIBROS_COLECCIONES,
        MODULOS_LIBROS_OFERTAR,
        MODULOS_LIBROS_CANTIDADES
    );

    public function __construct( $argv = array() )
    {
        parent::__construct('M&oacute;dulos');

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }
    }

    public function __onSubmit()
    {
        $modulos = array();
        $result = Db::query(
            "SELECT modulos.id_modulos
                  , modulos.nombre
             FROM modulos"
        );

        foreach ( (array) $result as $row )
            $modulos[$row['nombre']] = $row['id_modulos'];

        foreach ( $this->modulos as $nombre )
        {
            if ( isset($modulos[$nombre]) )
            {
                Db::update('modulos', array(
                    'activo' => ( isset($_POST[$nombre]) && $_POST[$nombre] == 1 ) ? 1 : 0
                ), "id_modulos = '$modulos[$nombre]'");
            }
            else
            {
                Db::insert('modulos', array(
                    'nombre' => $nombre,
                    'activo' => ( isset($_POST[$nombre]) && $_POST[$nombre] == 1 ) ? 1 : 0
                ));
            }
        }

        Web::redirect('/admincp/modulos/done/');
    }

    public function __toString()
    {
        /**
        foreach ( $this->modulos as $nombre => $label )
        {
            $this->block('each')
                 ->set('nombre', $nombre)
                 ->set('label', $label)
                 ->end();

            if ( $this->isModulo($nombre) )
                $this->block('each.checked')->end();
        }
         */

        foreach ( $this->modulos as $nombre )
        {
            if ( $this->isModulo($nombre) )
                $this->set("{$nombre}_checked", ' checked="checked"');
        }

        parent::__toString();
    }
}