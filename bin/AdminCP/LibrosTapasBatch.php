<?php

include_once "$root/bin/AdminCP/Base.php";
include_once "$root/inc/DefinedImage.php";

class AdminCP_LibrosTapasBatch extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct(array('Libros', 'Tapas'));

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        set_time_limit(0);
    }

    public function __onSubmit()
    {
        global $root;

        $libros = "$root/upl/libros";

        $delete = ( $_POST['delete'] == 1 );
        $path   = $_POST['path'];

        if ( strncmp($path, '/', 1) != 0 )
            $path = "/$path";

        $path = "$root$path";

        if ( substr($path, -1) == '/' )
            $path = substr($path, 0, strlen($path) - 1);

        if ( is_dir($path) )
        {
            $dir = dir($path);

            while ( false !== ( $entry = $dir->read() ) )
            {
                if ( $fileinfo = $this->fileinfo($entry) )
                {
                    $id        = $fileinfo['id'];
                    $roman     = ( isset($fileinfo['roman']) && strlen($fileinfo['roman']) > 0 ) ? $fileinfo['roman'] : 'i';
                    $extension = $fileinfo['extension'];
                    $current   = "$libros/$id";

                    thumbnail($current, "$path/$entry", $roman, $extension, $delete);
                }
            }

            $dir->close();

            Web::redirect('/admincp/libros/tapas/done/');
        }
    }

    protected function fileinfo( $file )
    {
        $pathinfo = explode('.', $file);

        $filename = array_shift($pathinfo);
        $extension = array_pop($pathinfo);

        if ( strlen($filename) > 0 )
        {
            $id = '';
            $roman = '';

            for ( $i = 0, $l = strlen($filename); $i < $l; $i++ )
            {
                $c = substr($filename, $i, 1);

                if ( is_numeric($c) )
                    $id .= $c;
                else
                    $roman .= $c;
            }

            return array(
                'id'        => $id,
                'roman'     => $roman,
                'filename'  => $filename,
                'extension' => $extension
            );
        }

        return false;
    }
}