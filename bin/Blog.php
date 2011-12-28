<?php

include_once "$root/bin/Base.php";

class Blog extends Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct( 'Blog' );

        $this->nav('Blog');

        $inLenf = 'LEFT';
        $and    = '';

        if ( strlen($argv[0]) > 0 )
        {
            $inLenf = 'INNER';
            $and    = "AND noticias_etiquetas.etiqueta = '$argv[0]'";

            $this->block('tag')->set('etiqueta', $argv[0])->end()
                 ->title( array( 'Blog', $argv[0] ) );
        }

        $meses = array(null, 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');

        $noticias = Db::query(
            "SELECT noticias.id_noticias
                  , noticias.titulo
                  , noticias.descripcion
                  , noticias.cuerpo
                  , noticias.fecha
                  , noticias_etiquetas.etiqueta
               FROM noticias
       $inLenf JOIN noticias_etiquetas
                 ON noticias_etiquetas.id_noticias = noticias.id_noticias
               $and
           ORDER BY noticias.fecha DESC"
        );

        $i = 0;

        while ( isset($noticias[$i]) )
        {
            $idNoticias = $noticias[$i]['id_noticias'];

            list ( $m, $d ) = explode('/', date('m/d', $noticias[$i]['fecha']));

            $noticias[$i]['cuerpo'] = textWiki($noticias[$i]['cuerpo']);
            $noticias[$i]['mes'] = $meses[intval($m)];
            $noticias[$i]['dia'] = $d;
            $noticias[$i]['url'] = $idNoticias . '+' . urlencode($noticias[$i]['titulo']);

            $comentarios = Db::query(
                "SELECT COUNT(*) AS total
                   FROM noticias_comentarios
                  WHERE id_noticias = '$idNoticias'"
            );

            $noticias[$i]['comentarios'] = $comentarios[0]['total'];
            $noticias[$i]['comentariosUrl'] = $noticias[$i]['url'] . '/#comentarios';

            $this->block('post')
                 ->set($noticias[$i])
                 ->end();

            while ( isset($noticias[$i]) && $idNoticias == $noticias[$i]['id_noticias'] )
            {
                $this->block('post.tags')->set($noticias[$i])->end();
                $i++;
            }
        }

        $this->cloud();
    }
}