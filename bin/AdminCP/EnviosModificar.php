<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_EnviosModificar extends AdminCP_Base
{
    public $type = 'text/html';

    private $idEnvios = 0;
    private $envio    = array();

    public function __construct( $argv = array() )
    {
        parent::__construct('Formas de Env&iacute;o');

        $this->idEnvios = intval($argv[0]);
        $this->envio = Db::query(
            "SELECT envios.id_envios
                  , envios.id_paises
                  , envios.nombre
                  , envios.local
                  , envios.cantidad_tipo
                  , envios.cantidad
                  , envios.entrega
                  , envios.precio
               FROM envios
              WHERE envios.id_envios = '{$this->idEnvios}'"
        );

        $this->envio = $this->envio[0];
        $this->envio['localChecked']  = $this->envio['local'] ? ' checked="checked"' : '';
        $this->envio['igualSelected'] = $this->envio['cantidad_tipo'] == '=' ? ' selected="selected"' : '';
        $this->envio['menorSelected'] = $this->envio['cantidad_tipo'] == '<' ? ' selected="selected"' : '';
        $this->envio['mayorSelected'] = $this->envio['cantidad_tipo'] == '>' ? ' selected="selected"' : '';

        $this->set($this->envio)
             ->title( array('Panel de Control', 'Formas de Env&iacute;o', $this->envio['nombre'], 'Modificar') );
             
        if ( $this->envio['local'] == 0 )
            $this->set('classHidden', 'hidden');
         
        $paises = Db::query(
            "SELECT paises.id_paises
                  , paises.pais
               FROM paises
           ORDER BY paises.pais"
        );

        foreach ( $paises as $pais ){
            $pais['selected'] = $pais['id_paises'] == $this->envio['id_paises'] ? ' selected="selected"' : '';
            $this->block('paises')->set($pais)->end();
        }
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
                
            Db::update('envios', array(
                'id_paises'     => $idPaises,
                'nombre'        => $values['nombre'],
                'local'         => isset( $values['local'] ) ? 1 : 0,
                'cantidad_tipo' => in_array( $values['cantidad_tipo'], $cantidadesTipos ) ? $values['cantidad_tipo'] : '=',
                'cantidad'      => $values['cantidad'],
                'entrega'       => $values['entrega'],
                'precio'        => $values['precio']
            ), "id_envios = '{$this->idEnvios}'");

            header('Location: /admincp/envios/done/');
        }

        $values['localChecked']  = isset( $values['local'] ) ? ' checked="checked"' : '';
        $values['igualSelected'] = $values['cantidad_tipo'] == '=' ? ' selected="selected"' : '';
        $values['menorSelected'] = $values['cantidad_tipo'] == '<' ? ' selected="selected"' : '';
        $values['mayorSelected'] = $values['cantidad_tipo'] == '>' ? ' selected="selected"' : '';

        $this->set($values);
    }
}