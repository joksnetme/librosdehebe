<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_ContactoVer extends AdminCP_Base
{
    public $type = 'text/html';
    protected $id = 0;

    public function __construct( $argv = array() )
    {
        parent::__construct();

        $this->id = $argv[0];

        if ( $this->id && is_numeric($this->id) )
            $this->view($this->id);
        else
            Web::redirect('/admincp/contacto/error/');
    }

    public function __onSubmit()
    {
        $id = (int) $_POST['id_contacto'];

        if ( !( $id ) || $id != $this->id )
            return;

        if ( isset($_POST['read']) )
            Db::update('contacto', array( 'leido' => 1 ), "id_contacto = '$id'");
        elseif ( isset($_POST['unread']) )
            Db::update('contacto', array( 'leido' => 0 ), "id_contacto = '$id'");

        Web::redirect("/admincp/contacto/$id/");
    }

    public function view( $id )
    {
        $result = Db::query(
            "SELECT contacto.id_contacto
                  , contacto.id_usuarios
                  , contacto.nombre
                  , contacto.email
                  , contacto.asunto
                  , contacto.mensaje
                  , contacto.client_ip
                  , contacto.user_agent
                  , contacto.leido
                  , contacto.fecha
             FROM contacto
             WHERE contacto.id_contacto = '$id'"
        );

        $contacto = $result[0];
        $contacto['fecha'] = date('d/m/Y H:i', $contacto['fecha']);

        if ( $contacto['id_usuarios'] )
        {
            $this->block('userLink')
                 ->set('id_usuarios', $contacto['id_usuarios'])
                 ->end();
        }

        $contacto['mensaje'] = textFormat($contacto['mensaje']);

        $this->title(
            array('Panel de Control', 'Mensajes', $contacto['asunto'])
        );

        $this->set($contacto)
             ->end();

        if ( $contacto['leido'] == 1 )
            $this->block('unread')->end();
        else
            $this->block('read')->end();
    }
}