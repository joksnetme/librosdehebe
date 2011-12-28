<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_FaqCategorias extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct(array('Preguntas Frecuentes', 'Categorias'));

        $result = Db::query(
            "SELECT faq_categorias.id_faq_categorias
                  , faq_categorias.nombre
                  , COUNT(faq.id_faq) AS preguntas
             FROM faq_categorias
             LEFT JOIN faq
                    ON faq.id_faq_categorias = faq_categorias.id_faq_categorias
             GROUP BY faq_categorias.id_faq_categorias
             ORDER BY faq_categorias.nombre"
        );

        if ( $argv[0] == 'error' )
        {
            $this->block('validation')->end()
                 ->block('validation.error')->end();
        }

        if ( $argv[0] == 'done' )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        if ( ( $numRows = sizeof($result) ) > 0 )
        {
            foreach ( $result as $row )
            {
                $pos++;

                $this->block('each')
                     ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                     ->set('pos', $pos)
                     ->set('id', $row['id_faq_categorias'])
                     ->set($row)
                     ->end();
            }
        }
    }
}