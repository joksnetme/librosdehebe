<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_LibrosTapasBorrar extends AdminCP_Base
{
    public $type = 'text/html';

    private $thumbs = array('/', '/75x100/', '/120x160/', '/190x255/', '/250x330/');

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $idLibros = intval($argv[0]);
        $romano   = strtolower($argv[1]);
        $path     = "upl/libros/$idLibros";
        
        foreach ( $this->thumbs as $thumbDir )
            @unlink("{$path}{$thumbDir}{$romano}.jpg");

        reOrderImages($idLibros);
        
        Web::redirect("/admincp/libros/$idLibros/tapas/done/");
    }
}