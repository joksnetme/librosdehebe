<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_FaqVer extends AdminCP_Base
{
    public $type = 'text/html';

    protected $id = 0;
    protected $done = false;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];
        $this->done = ( $argv[1] == 'done' );

        if ( $this->id && is_numeric($this->id) )
            $this->view($this->id);
        else
            Web::redirect('/admincp/faq/error/');
    }

    public function view( $id )
    {
        if ( $this->done )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $result = Db::query(
            "SELECT faq.id_faq
                  , faq.pregunta
                  , faq.respuesta
                  , faq.fecha
                  , faq_categorias.id_faq_categorias
                  , faq_categorias.nombre AS categoria
             FROM faq
             INNER JOIN faq_categorias
                     ON faq_categorias.id_faq_categorias = faq.id_faq_categorias
             WHERE faq.id_faq = '$id'
             ORDER BY faq_categorias.id_faq_categorias
                    , faq.pos"
        );

        $faq = $result[0];
        $faq['fecha'] = date('d/m/Y H:i', $faq['fecha']);
        $faq['respuesta'] = textFormat($faq['respuesta']);

        $this->title(
            array('Panel de Control', 'Preguntas Frecuentes', $faq['pregunta'])
        );

        $this->set($faq)
             ->end();
    }
}