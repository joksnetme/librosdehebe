<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_LibreriasStockCambiar extends AdminCP_Base
{
    public $type = 'text/html';

    protected $idLibrerias = 0;
    protected $idLibros    = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->idLibrerias = intval($argv[0]);
        $this->idLibros    = intval($argv[1]);
    }

    public function __onSubmit()
    {
        $stock = Db::query(
            "SELECT librerias_stock.idLibrerias_stock
               FROM librerias_stock
              WHERE librerias_stock.idLibrerias = '$this->idLibrerias'
                AND librerias_stock.idLibros = '$this->idLibros'"
        );

        if ( strlen($stock[0]['idLibrerias_stock']) > 0 )
            Db::update('librerias_stock', array(
                'cantidad' => intval($_POST['cantidad'])
            ), "idLibrerias_stock = '{$stock[0]['idLibrerias_stock']}'");

        else
            Db::insert('librerias_stock', array(
                'idLibrerias' => $this->idLibrerias,
                'idLibros'    => $this->idLibros,
                'cantidad'    => intval($_POST['cantidad'])
            ));

        exit();
    }
}