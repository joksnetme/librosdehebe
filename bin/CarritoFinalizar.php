<?php

include_once "$root/bin/Base.php";

class CarritoFinalizar extends Base
{
    public $type = 'text/html';
    
    private $idCompras = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct('Carrito de Compras');

        $this->nav('Carrito');

        if ( !$this->user->login )
            $this->block('registerLogin')->end();

        else
        {
            $data = $this->user->extras;
            $data['nombre'] = $this->user->data['nombre'];
            
            if ( isset($argv[0]) )
            {
                $this->idCompras = $argv[0];
                
                $this->set('prevCompra', "$argv[0]/");
                
                $this->block('cancelar')->set(array('id_compras' => $this->idCompras))->end();
                
                $compra = Db::query(
                    "SELECT compras.nombre
                          , compras.estado
                          , compras.ciudad
                          , compras.direccion1
                          , compras.direccion2
                          , compras.codigo_area
                          , compras.telefono
                          , compras.cp
                       FROM compras
                      WHERE compras.id_compras = '{$argv[0]}'
                        AND compras.id_usuarios = '{$this->user->id}'"
                );
                
                $data = $compra[0];
            }
            else
                $this->block('anterior')->end();
            
            $this->set(array(
                'nombre'     => $data['nombre'],
                'estado'     => $data['estado'],
                'ciudad'     => $data['ciudad'],
                'direccion'  => $data['direccion1'],
                'direccion2' => $data['direccion2'],
                'codigoArea' => $data['codigo_area'],
                'telefono'   => $data['telefono'],
                'cp'         => $data['cp']
            ));
        }
        
        $paises = Db::query(
            "SELECT paises.id_paises
                  , paises.pais
                  , paises.codigo
               FROM paises
           ORDER BY paises.pais"
        );
        
        foreach ( $paises as $pais ){

            if ( $pais['id_paises'] == $this->user->extras['id_paises'] ){
                $this->set('codigoPais', $pais['codigo']);
                $pais['selected'] = ' selected="selected"';
            }

            $this->block('paises')->set($pais)->end();
        }

    }
    
    public function __onSubmit(){
    
        $this->validation(array(
            'nombre'     => 'required',
            'pais'       => 'required',
            'estado'     => 'required',
            'ciudad'     => 'required',
            'direccion'  => 'required',
            'codigoArea' => 'required',
            'telefono'   => 'required',
            'cp'         => 'required'
        ));
    
        $this->validation();
        
        if ( $this->isValid() ){
    
            if ( !$this->user->login )
            {
                if ( strlen($_POST['correo']) > 0 )
                {
                    $this->validation(array(
                        'correo' => array( 'required' => true, 'email' => true ),
                        'clave'  => array( 'required' => true, 'rangeLength' => array(6, 12) )
                    ));
    
                    if ( $this->isValid() )
                    {
                        $correo = $_POST['correo'];
                        $clave  = md5($_POST['clave']);
    
                        $data = Db::query(
                           "SELECT id_usuarios
                              FROM usuarios
                             WHERE correo = '$correo'
                               AND clave = '$clave'
                             LIMIT 1"
                        );
    
                        if ( $data[0]['id_usuarios'] > 0 ){
                            Cookies::set('LDH_UID', $data[0]['id_usuarios'], time() + 3600);
                            $this->user = new User($data[0]['id_usuarios']);
                        }
                    }
                }
                else
                {
                    $correo = $_POST['r_correo'];
                    $clave  = $_POST['r_clave'];
                    $clave2 = $_POST['r_clave2'];
    
                    $this->validation(array(
                        'r_correo' => 'email',
                        'r_clave'  => array( 'required' => true, 'rangeLength' => array(6, 12) ),
                        'r_clave2' => array( 'equalTo' => $clave )
                    ));
    
                    if ( $this->isValid() ){
    
                        $idUsuarios = Db::insert('usuarios', array(
                            'correo' => $correo,
                            'clave'  => md5( $clave ),
                            'nombre' => $_POST['nombre']
                        ));

                        Cookies::set('LDH_UID', $idUsuarios, time() + 3600);
                        $this->user = new User($idUsuarios);
                    }
                }
            }
            
            if ( $this->user->login )
            {
                $compra = array(
                    'id_paises'   => intval($_POST['pais']),
                    'nombre'      => $_POST['nombre'],
                    'estado'      => $_POST['estado'],
                    'ciudad'      => $_POST['ciudad'],
                    'direccion1'  => $_POST['direccion'],
                    'direccion2'  => $_POST['direccion2'],
                    'codigo_area' => $_POST['codigoArea'],
                    'telefono'    => $_POST['telefono'],
                    'cp'          => $_POST['cp']
                );
                
                if ( $this->idCompras > 0 )
                {
                    Db::update('compras', $compra, "id_compras = '$this->idCompras'");
                    $idCompras = $this->idCompras;
                }
                else
                {
                    $compra['id_usuarios'] = $this->user->id;
                    $compra['fecha']       = time();

                    $idCompras = Db::insert('compras', $compra);

                    $items = Db::query(
                        "SELECT carrito.id_carrito
                           FROM carrito
                          WHERE ( carrito.id_usuarios = '{$this->user->id}' OR carrito.ip = '" . Web::getIp() . "' )
                            AND carrito.finalizado = 0"
                    );
    
                    foreach ( $items as $item )
                    {
                        Db::insert('compras_items', array(
                            'id_compras' => $idCompras,
                            'id_carrito' => $item['id_carrito']
                        ));
    
                        Db::update('carrito', array(
                            'finalizado' => 1
                        ), "id_carrito = '{$item['id_carrito']}'");
                    }
                }
                
                Web::redirect("/carrito/finalizar/$idCompras/2/");
            }
        }
        $this->set($_POST);
    }
}