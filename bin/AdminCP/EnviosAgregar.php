<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_EnviosAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct( array('Formas de Env&iacute;o', 'Agregar') );
        
        $paises = Db::query(
            "SELECT paises.id_paises
                  , paises.pais
               FROM paises
           ORDER BY paises.pais"
        );

        foreach ( $paises as $pais )
            $this->block('paises')->set($pais)->end();
    }

    public function __onSubmit()
    {
        $values = $_POST;

        $validate = array(
            'nombre'        => 'required',
            'cantidad_tipo' => 'required',
            'cantidad'      => 'required',
            'entrega'       => 'required',
            'precio'        => array( 'required' => true, 'number' => true )
        );

        if ( isset( $values['local'] ) )
            $validate['pais'] = 'required';
            
        $this->validation($validate);

        $cantidadesTipos = array('=', '<', '>');

        if ( $this->isValid() )
        {
            $idPaises = isset( $values['local'] ) ? intval($_POST['pais']) : 0;
        
            Db::insert('envios', array(
                'id_paises'     => $idPaises,
                'nombre'        => $values['nombre'],
                'local'         => isset( $values['local'] ) ? 1 : 0,
                'cantidad_tipo' => in_array( $values['cantidad_tipo'], $cantidadesTipos ) ? $values['cantidad_tipo'] : '=',
                'cantidad'      => $values['cantidad'],
                'entrega'       => $values['entrega'],
                'precio'        => $values['precio']
            ));

            header('Location: /admincp/envios/done/');
        }

        $values['localChecked']  = isset( $values['local'] ) ? ' checked="checked"' : '';
        $values['igualSelected'] = $values['cantidad_tipo'] == '=' ? ' selected="selected"' : '';
        $values['menorSelected'] = $values['cantidad_tipo'] == '<' ? ' selected="selected"' : '';
        $values['mayorSelected'] = $values['cantidad_tipo'] == '>' ? ' selected="selected"' : '';

        $this->set($values);
    }
}