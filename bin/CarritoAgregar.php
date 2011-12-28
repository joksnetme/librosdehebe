<?php

include_once "$root/bin/Base.php";

class CarritoAgregar extends Base
{
    public $type = 'text/html';
    
    private $idUsuarios = 0;
    private $ip;
    
    public function __construct( $argv = array() )
    {
        parent::__construct('Carrito');

        $this->ip = Web::getIP();
        
        $this->agregar = ( $argv[0] == 'agregar' );
        $this->ofertar = ( $argv[0] == 'ofertar' && $this->isModulo(MODULOS_LIBROS_OFERTAR) );

        if ( $this->user->login )
            $this->idUsuarios = $this->user->id;
            
        if ( is_numeric($argv[0]) && $argv[1] == 'agregar' )
            $this->add(intval($argv[0]), 0);
    }
    
    public function __onSubmit()
    {
        $idLibros = intval($_POST['id_libros']);
        $oferta   = floatval($_POST['oferta']);
        
        $this->add($idLibros, $oferta);
    }
    
    private function add( $idLibros, $oferta )
    {
        $where = $this->user->login
               ? "( id_usuarios = '$this->idUsuarios' OR ip = '$this->ip' )"
               : "ip = '$this->ip'";

        $check = Db::query(
            "SELECT carrito.id_carrito
               FROM carrito
              WHERE carrito.id_libros = '$idLibros'
                AND $where"
        );

        if ( strlen($check[0]['id_carrito']) == 0 )
        {
            Db::insert('carrito', array(
                'id_usuarios' => $this->idUsuarios,
                'id_libros'   => $idLibros,
                'ip'          => $this->ip,
                'oferta'      => $this->ofertar ? $oferta : 0,
                'fecha'       => time()
            ));
        }
        elseif ( $this->isModulo(MODULOS_LIBROS_CANTIDADES) )
        {
            Db::query(
                "UPDATE carrito
                    SET cantidad = cantidad + 1
                  WHERE id_carrito = '{$check[0]['id_carrito']}'
                    AND $where"
            );
        }
        
        header('Location: /carrito/done/');
    }
}