<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Faq extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Preguntas Frecuentes');

        $result = Db::query(
            "SELECT faq.id_faq
                  , faq.pregunta
                  , faq.fecha
                  , faq_categorias.id_faq_categorias
                  , faq_categorias.nombre AS categoria
             FROM faq
             INNER JOIN faq_categorias
                     ON faq_categorias.id_faq_categorias = faq.id_faq_categorias
             ORDER BY faq_categorias.id_faq_categorias
                    , faq.pos"
        );

        if ( $argv[0] == 'error' )
        {
            $this->block('validation')->end()
                 ->block('validation.error')->end();
        }

        $cat = array();

        if ( ( $numRows = sizeof($result) ) > 0 )
        {
            $pos = 0;

            foreach ( $result as $row )
            {
                $pos++;

                $cat[$row['id_faq_categorias']] = $row['categoria'];

                $row['fecha'] = date('d/m/Y H:i', $row['fecha']);
                $row['respuesta'] = textFormat($row['respuesta']);

                $this->block('each')
                     ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                     ->set('pos', $pos)
                     ->set('id', $row['id_faq'])
                     ->set($row)
                     ->end();
            }

            $pos = 0;

            foreach ( $cat as $id => $nombre )
            {
                $pos++;

                $this->block('categorias')
                     ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                     ->set('pos', $pos)
                     ->set('id', $id)
                     ->set('nombre', $nombre)
                     ->end();
            }
        }

        $numRowsCats = sizeof($cat);

        if ( $numRows != 1 ) $this->set('s', 's');
        if ( $numRowsCats != 1 ) $this->set('sc', 's');

        $this->set('count', $numRows)
             ->set('countCat', $numRowsCats)
             ->end();
    }
}