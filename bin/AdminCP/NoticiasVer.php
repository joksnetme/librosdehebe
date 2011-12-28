<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_NoticiasVer extends AdminCP_Base
{
    public $type = 'text/html';

    protected $idNoticias = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        if ( $this->idNoticias = intval( $argv[0] ) )
        {
            $result = Db::query(
                "SELECT noticias.id_noticias
                      , noticias.titulo
                      , noticias.cuerpo
                      , noticias.descripcion
                      , noticias.fecha
                      , GROUP_CONCAT(noticias_etiquetas.etiqueta ORDER BY noticias_etiquetas.id_noticias_etiquetas SEPARATOR ' ')  AS etiquetas
                   FROM noticias
              LEFT JOIN noticias_etiquetas
                     ON noticias_etiquetas.id_noticias = noticias.id_noticias
                  WHERE noticias.id_noticias = '$this->idNoticias'
               GROUP BY noticias.id_noticias"
            );

            $noticia = $result[0];
            $noticia['fecha']  = date('d/m/Y H:i', $noticia['fecha']);
            # $noticia['cuerpo'] = textWiki( $noticia['cuerpo'] );
            $noticia['cuerpo'] = textFormat( $noticia['cuerpo'] );

            $this->set($noticia)
                 ->title( array('Panel de Control', 'Noticias', $noticia['titulo']) );;
        }
    }
}