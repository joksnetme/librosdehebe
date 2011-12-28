<?php

include_once "$root/bin/Base.php";

class Faq extends Base
{
    public $type = 'text/html';

    protected $faq = array();

    public function __construct()
    {
        parent::__construct('Preguntas Frecuentes');

        $this->faq = Db::query(
            'SELECT faq.id_faq
                  , faq.pregunta
                  , faq.respuesta
                  , faq_categorias.id_faq_categorias
                  , faq_categorias.nombre AS categoria
             FROM faq
             INNER JOIN faq_categorias
                     ON faq_categorias.id_faq_categorias = faq.id_faq_categorias
             ORDER BY faq_categorias.id_faq_categorias
                    , faq.pos'
        );

        $this->nav('Preguntas Frecuentes');
    }

    public function __toString()
    {
        $idFaqCategorias = 0;

        foreach ( $this->faq as $row )
        {
            if ( $idFaqCategorias != $row['id_faq_categorias'] )
            {
                $this->block('categoria')
                     ->set('categoria', $row['categoria'])
                     ->end();

                 $idFaqCategorias = $row['id_faq_categorias'];
            }

            $this->block('categoria.each')
                 ->set('id', $row['id_faq'])
                 ->set('pregunta', $row['pregunta'])
                 ->set('respuesta', textFormat($row['respuesta']))
                 ->end();
        }

        return parent::__toString();
    }
}