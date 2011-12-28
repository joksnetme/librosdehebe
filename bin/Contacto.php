<?php

include_once "$root/bin/Base.php";

class Contacto extends Base
{
    public $type = 'text/html';

    public function __construct()
    {
        parent::__construct('Contacto');

        $this->nav('Contacto');

        if ( $this->user->login )
            $this->contact();
    }

    public function __onSubmit()
    {
        Db::insert('contacto', array(
            'id_usuarios' => $this->user->id,
            'nombre'      => $_POST['nombre'],
            'email'       => $_POST['email'],
            'asunto'      => $_POST['asunto'],
            'mensaje'     => $_POST['mensaje'],
            'client_ip'   => Web::getIP(),
            'user_agent'  => Web::getUserAgent(),
            'fecha'       => time()
        ));

        Web::redirect('/contacto/gracias/');
    }

    public function contact()
    {
        if ( $this->user->login )
        {
            $this->set('nombre', $this->user->data['nombre'])
                 ->set('email', $this->user->data['correo'])
                 ->end();
        }
    }
}