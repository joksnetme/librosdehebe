<?php

include_once "$root/bin/Base.php";

class BlogNoticia extends Base
{
    public $type = 'text/html';

    protected $idNoticias = 0;
    protected $url = '';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->idNoticias = intval( $argv[0] );

        if ( $this->idNoticias )
            $this->noticia($this->idNoticias);

        $this->cloud();
    }

    protected function noticia( $idNoticias )
    {
        $noticia = Db::query(
            "SELECT noticias.id_noticias
                  , noticias.titulo
                  , noticias.descripcion
                  , noticias.cuerpo
                  , noticias.fecha
                  , noticias_etiquetas.etiqueta
               FROM noticias
          LEFT JOIN noticias_etiquetas
                 ON noticias_etiquetas.id_noticias = noticias.id_noticias
              WHERE noticias.id_noticias = '$idNoticias'"
        );

        $meses = array(null, 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');

        list ( $m, $d ) = explode('/', date('m/d', $noticia[0]['fecha']));

        $noticia[0]['cuerpo'] = textWiki( $noticia[0]['cuerpo'] );
        $noticia[0]['mes']    = $meses[intval($m)];
        $noticia[0]['dia']    = $d;
        $noticia[0]['furl']   = $idNoticias . '+' . urlencode($noticia[0]['titulo']);

        $this->set( $noticia[0] )
             ->title( array( 'Blog', $noticia[0]['titulo'] ) );

        $i = 0;

        while ( isset($noticia[$i]) )
        {
            $this->block('tags')
                 ->set($noticia[$i])
                 ->end();

            $i++;
        }

        $this->url = $noticia[0]['furl'];
        $this->comentarios($idNoticias);
    }

    private function comentarios( $idNoticias )
    {
        $comentarios = Db::query(
            "SELECT noticias_comentarios.id_noticias_comentarios
                  , noticias_comentarios.nombre
                  , noticias_comentarios.email
                  , noticias_comentarios.url
                  , noticias_comentarios.comentario
                  , noticias_comentarios.fecha
                  , COUNT(noticias_comentarios2.id_noticias_comentarios) AS comentarios
               FROM noticias_comentarios
          LEFT JOIN noticias_comentarios noticias_comentarios2
                 ON noticias_comentarios2.id_noticias = noticias_comentarios.id_noticias
              WHERE noticias_comentarios.id_noticias = '$idNoticias'
           GROUP BY noticias_comentarios.id_noticias_comentarios"
        );

        $this->set('comentarios', $comentarios[0]['comentarios']);

        foreach ( $comentarios as $comentario )
        {
            $comentario['fecha'] = date('d/m/Y H:i', $comentario['fecha']);
            $comentario['comentario'] = textFormat($comentario['comentario']);

            $this->block('comments')->set($comentario)->end();

            if ( strlen($comentario['url']) > 0 )
                $this->block('comments.ifUrl')->end();
            else
                $this->block('comments.notUrl')->end();
        }

        if ( $this->user->login )
        {
            $this->set(array(
                'nombre' => $this->user->data['nombre'],
                'email'  => $this->user->data['correo']
            ));
        }
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'nombre'     => 'required',
            'email'      => array('required' => true, 'email' => true),
            'url'        => array( 'url' => true ),
            'comentario' => 'required'
        ));

        if ( $this->isValid() )
        {
            $idNoticiasComentarios = Db::insert('noticias_comentarios', array(
                'id_noticias' => $this->idNoticias,
                'nombre'      => $_POST['nombre'],
                'email'       => $_POST['email'],
                'url'         => $_POST['url'],
                'comentario'  => $_POST['comentario'],
                'fecha'       => time()
            ));

            header("Location: /blog/$this->url/");
        }

        $this->set($_POST);
    }
}