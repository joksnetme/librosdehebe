<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_FaqCategoriasAgregarPregunta extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;
    protected $idFaq = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];

        if ( $this->id )
            $this->add($this->id);
        else
            Web::redirect('/admincp/faq/categorias/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_faq_categorias'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'pregunta'  => 'required',
            'respuesta' => 'required'
        ));

        if ( $this->isValid() )
        {
            $result = Db::query(
                "SELECT MAX(faq.pos) AS max
                 FROM faq"
            );

            if ( !( $result ) )
                return;

            $pos = $result[0]['max'];

            $this->idFaq = Db::insert('faq', array(
                'id_faq_categorias' => $id,
                'pregunta'          => trim( $_POST['pregunta'] ),
                'respuesta'         => $_POST['respuesta'],
                'fecha'             => time(),
                'pos'               => $pos
            ));

            Web::redirect("/admincp/faq/{$this->idFaq}/done/");
        }
    }

    public function add( $id )
    {
        $result = Db::query(
            "SELECT faq_categorias.id_faq_categorias
                  , faq_categorias.nombre
             FROM faq_categorias
             WHERE faq_categorias.id_faq_categorias = '$id'"
        );

        if ( sizeof($result) == 0 )
            Web::redirect('/admincp/faq/categorias/error/');

        $categoria = $result[0];

        $this->title(
            array('Panel de Control', 'Preguntas Frecuentes', 'Categorias', $categoria['nombre'], 'Agregar Pregunta')
        );

        $this->set($categoria)
             ->end();

        $this->specialchars();
    }
}