<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_FaqCategoriasVer extends AdminCP_Base
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
        {
            $this->view($this->id);
            $this->search($this->id);
        }
        else
            Web::redirect('/admincp/faq/categorias/error/');
    }

    public function view( $id )
    {
        if ( $this->done )
        {
            $this->block('validation')->end()
                 ->block('validation.done')->end();
        }

        $result = Db::query(
            "SELECT faq_categorias.id_faq_categorias
                  , faq_categorias.nombre
             FROM faq_categorias
             WHERE faq_categorias.id_faq_categorias = '$id'"
        );

        $categoria = $result[0];

        $this->title(
            array('Panel de Control', 'Preguntas Frecuentes', 'Categorias', $categoria['nombre'])
        );

        $this->set($categoria)
             ->end();
    }

    public function search( $id )
    {
        $result = Db::query(
            "SELECT faq.id_faq
                  , faq.pregunta
                  , faq.fecha
             FROM faq
             WHERE faq.id_faq_categorias = '$id'
             ORDER BY faq.pos"
        );

        if ( ( $numRows = sizeof($result) ) > 0 )
        {
            $pos = 0;

            foreach ( $result as $row )
            {
                $pos++;

                $row['fecha'] = date('d/m/Y H:i', $row['fecha']);

                $this->block('each')
                     ->set('class', ( $pos % 2 == 0 ) ? 'even' : 'odd')
                     ->set('pos', $pos)
                     ->set('id', $row['id_faq'])
                     ->set($row)
                     ->end();
            }
        }
    }
}