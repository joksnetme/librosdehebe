<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_NoticiasModificar extends AdminCP_Base
{
    public $type = 'text/html';

    protected $idNoticias = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->idNoticias = intval($argv[0]);

        if ( $this->idNoticias )
        {
            $result = Db::query(
                "SELECT noticias.id_noticias
                      , noticias.titulo
                      , noticias.cuerpo
                      , noticias.descripcion
                      , GROUP_CONCAT(noticias_etiquetas.etiqueta ORDER BY noticias_etiquetas.id_noticias_etiquetas SEPARATOR ' ')  AS etiquetas
                   FROM noticias
              LEFT JOIN noticias_etiquetas
                     ON noticias_etiquetas.id_noticias = noticias.id_noticias
                  WHERE noticias.id_noticias = '$this->idNoticias'
               GROUP BY noticias.id_noticias"
            );

            $noticia = $result[0];
            # $noticia['cuerpo'] = textWiki( $noticia['cuerpo'] );
            # $noticia['cuerpo'] = htmlspecialchars( $noticia['cuerpo'] );

            $this->set($noticia)
                 ->title( array('Panel de Control', 'Noticias', $noticia['titulo'], 'Modificar') );
        }

        $this->specialchars();
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_noticias'];

        if ( !( $id ) || $id != $this->idNoticias )
            return;

        $this->validation(array(
            'titulo'      => 'required',
            'descripcion' => 'required',
            'cuerpo'      => 'required',
            'etiquetas'   => 'required'
        ));

        if ( $this->isValid() )
        {
            $etiquetas = explode(' ', trim( $_POST['etiquetas'] ));

            Db::update('noticias', array(
                'titulo'      => $_POST['titulo'],
                'cuerpo'      => $_POST['cuerpo'],
                'descripcion' => $_POST['descripcion']
              # 'fecha'       => time()
            ), "id_noticias = '$this->idNoticias'");

            $idsEtiquetas = array(0);

            foreach ( $etiquetas as $etiqueta )
            {

                $tag = Db::query(
                    "SELECT noticias_etiquetas.id_noticias_etiquetas
                       FROM noticias_etiquetas
                      WHERE noticias_etiquetas.id_noticias = '$this->idNoticias'
                        AND LCASE(noticias_etiquetas.etiqueta) = '" . strtolower($etiqueta) . "'"
                );

                if ( strlen($tag[0]['id_noticias_etiquetas']) > 0 )
                    $idsEtiquetas[] = $tag[0]['id_noticias_etiquetas'];
                else
                {
                    $idsEtiquetas[] = Db::insert('noticias_etiquetas', array(
                        'id_noticias' => $this->idNoticias,
                        'etiqueta' => $etiqueta
                    ));
                }
            }

            Db::query(
                "DELETE FROM noticias_etiquetas
                       WHERE id_noticias = '$this->idNoticias'
                         AND id_noticias_etiquetas NOT IN('" . implode("', '", $idsEtiquetas) . "')"
            );

            Web::redirect('/admincp/noticias/done/');
        }

        $this->set($_POST);
    }
}