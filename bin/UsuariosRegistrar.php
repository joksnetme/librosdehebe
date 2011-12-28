<?php

include_once "$root/bin/Base.php";

class UsuariosRegistrar extends Base
{
    public $type = 'text/html';

    public function __construct( $argv = array() )
    {
        parent::__construct('Registrarse');

        if ( $this->user->login )
            Web::redirect('/usercp/');

        $email = Cookies::get('LDH_EMAIL');

        if ( $email )
        {
            $this->set('correo', $email);

            if ( !( Web::isPost() ) )
            {
                $parts = explode('@', $email);
                $name = $parts[0];

                if ( strpos($name, '.') !== false )
                    $name = ucwords( str_replace('.', ' ', $name) );
                else
                    $name = ucfirst($name);

                $this->set('nombre', $name);
            }
        }
    }

    public function __onSubmit()
    {
        $this->validation(array(
            'nombre' => 'required',
            'clave'  => array( 'required' => true, 'rangeLength' => array(6, 12) ),
            'clave2' => array( 'equalTo' => $_POST['clave'] )
        ));

        if ( $this->isValid() )
        {
            Db::insert('usuarios', array(
                'correo' => $_POST['correo'],
                'clave'  => md5( $_POST['clave'] ),
                'nombre' => $_POST['nombre']
            ));

            Web::redirect("/login/");
        }

        $this->set($_POST);
    }
}