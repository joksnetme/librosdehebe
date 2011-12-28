<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_LibrosTapas extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;
    protected $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];
        $this->done = ( $argv[1] == 'done' );

        if ( $this->done )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        global $root;
        
        include_once $root . '/inc/DefinedImage.php';

        if ( $this->id )
            $this->tapas($this->id);
        else
            Web::redirect('/admincp/libros/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_libros'];

        if ( !( $id ) || $id != $this->id )
            return;
            
        if ( $_FILES['tapa']['error'] == 0 && $_FILES['tapa']['size'] > 0 ){
            
            $path = "upl/libros/$id";
            $dir  = opendir($path);

            $levels = array('.', '..');
            $max    = 0;

            while ( $file = readdir($dir)  )
            {
                if ( !in_array($file, $levels) && is_file("$path/$file") )
                {
                    $roman = str_replace('.jpg', '', $file);
                    
                    if ( ($decimal = roman2dec($roman)) > $max )
                        $max = $decimal;
                }
            }
            
            thumbnail($path, $_FILES['tapa']['tmp_name'], toRoman(++$max), 'jpg');
        }
        
        Web::redirect("/admincp/libros/$id/tapas/done/");
    }

    public function tapas( $id )
    {
        $result = Db::query(
            "SELECT libros.id_libros
                  , libros.titulo
             FROM libros
             WHERE libros.id_libros = '$id'"
        );

        $libro = $result[0];

        $this->title(
            array('Panel de Control', 'Libros', $libro['titulo'], 'Tapas')
        );

        $this->set($libro)
             ->end();
             
        # Tapas
        
        $path = "upl/libros/$this->id/";
        $i    = 1;
        $rom  = 'i';
        
        do
        {
            $this->block('tapas')->set(array(
                'src'   => "/$path/75x100/$rom.jpg",
                'rom'   => $rom
            ));
            
            $rom = toRoman(++$i);
        }
        while ( is_file("$path/75x100/$rom.jpg") );
    }
}