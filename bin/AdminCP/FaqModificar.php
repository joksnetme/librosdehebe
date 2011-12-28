<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_FaqModificar extends AdminCP_Base
{
    public $type = 'text/html';
    protected $id = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        if ( $this->id = $argv[0] )
            $this->modify($this->id);
        else
            Web::redirect('/admincp/faq/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_faq'];

        if ( !( $id ) || $id != $this->id )
            return;

        $this->validation(array(
            'pregunta'  => 'required',
            'respuesta' => 'required'
        ));

        if ( $this->isValid() )
        {
            Db::update('faq', array(
                'pregunta'  => trim( $_POST['pregunta'] ),
                'respuesta' => trim( $_POST['respuesta'] )
            ), "id_faq = '$id'");

            Web::redirect("/admincp/faq/$id/done/");
        }
    }

    public function modify( $id )
    {
        $result = Db::query(
            "SELECT faq.id_faq
                  , faq.id_faq_categorias
                  , faq.pregunta
                  , faq.respuesta
                  , faq_categorias.nombre AS categoria
             FROM faq
             INNER JOIN faq_categorias
                     ON faq_categorias.id_faq_categorias = faq.id_faq_categorias
             WHERE faq.id_faq = '$id'"
        );

        if ( sizeof($result) == 0 )
            Web::redirect('/admincp/faq/error/');

        $faq = $result[0];

        $this->title(
            array('Panel de Control', 'Preguntas Frecuentes', $faq['pregunta'], 'Modificar')
        );

        $this->set($faq)
             ->end();

        $this->specialchars();
    }
}