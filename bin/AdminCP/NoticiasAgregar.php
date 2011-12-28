<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_NoticiasAgregar extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->title( array('Panel de Control', 'Noticias', 'Agregar') )
             ->specialchars();
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'titulo'      => 'required',
            'descripcion' => 'required',
            'cuerpo'      => 'required',
            'etiquetas'   => 'required'
        ));

        if ( $this->isValid() )
        {
            $etiquetas = explode(' ', trim($_POST['etiquetas']));

            $idNoticias = Db::insert('noticias', array(
                'titulo' => $_POST['titulo'],
                'cuerpo' => $_POST['cuerpo'],
                'descripcion' => $_POST['descripcion'],
                'fecha'  => time()
            ));

            foreach ( $etiquetas as $etiqueta )
            {
                Db::insert('noticias_etiquetas', array(
                    'id_noticias' => $idNoticias,
                    'etiqueta'    => $etiqueta
                ));
            }

            Web::redirect('/admincp/noticias/done/');
        }

        $this->set($_POST);
    }
}