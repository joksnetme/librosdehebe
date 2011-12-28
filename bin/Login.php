<?php

include_once "$root/bin/Base.php";

class Login extends Base
{
    public $type = 'text/html';

    protected $cheched = 'Login';

    public function __construct()
    {
        parent::__construct('Ingresar');

        if ( $this->user->login )
            Web::redirect('/usercp/');

        $this->nav('Login');
    }

    public function __onSubmit()
    {
        $this->cheched = ucfirst( $_POST['choice'] );

        switch ( $_POST['choice'] )
        {
            case 'login':
                $this->validation(array(
                    'correo' => array( 'required' => true, 'email' => true ),
                    'clave'  => array( 'required' => true, 'rangeLength' => array(6, 12) )
                ));

                if ( $this->isValid() )
                {
                    $email = $_POST['correo'];
                    $password = md5($_POST['clave']);

                    $sql = "SELECT id_usuarios
                            FROM usuarios
                            WHERE correo = '$email'
                              AND clave = '$password'
                            LIMIT 1";

                    if ( $data = Db::query($sql) )
                    {
                        Cookies::set('LDH_UID', $data[0]['id_usuarios'], time() + 3600);

                        Db::update('usuarios', array(
                            'ultimo' => time()
                        ), "id_usuarios = '{$data[0]['id_usuarios']}'");

                        Web::redirect('/usercp/');
                    }

                    $this->block('not_found')->end();
                }

                break;

            case 'register':

                $this->validation(array(
                    'correo' => array( 'required' => true, 'email' => true )
                ));

                if ( $this->isValid() )
                {
                    $email = $_POST['correo'];
                    $sql = "SELECT id_usuarios
                            FROM usuarios
                            WHERE correo = '$email'
                            LIMIT 1";

                    if ( $data = Db::query($sql) )
                        $this->block('already_found')->end();
                    else
                    {
                        Cookies::set('LDH_EMAIL', $_POST['correo'], time() + 3600);
                        Web::redirect('/usuarios/registrar/');
                    }
                }

                break;

            case 'password':
                $this->validation(array(
                    'correo' => array( 'required' => true, 'email' => true )
                ));

                if ( $this->isValid() )
                {
                    $email = $_POST['correo'];
                    $sql = "SELECT id_usuarios
                            FROM usuarios
                            WHERE correo = '$email'
                            LIMIT 1";

                    if ( $data = Db::query($sql) )
                        Web::redirect("/usuarios/{$data[0]['id_usuarios']}/recuperar/");

                    $this->block('not_found_mail')->end();
                }

                break;

            default:
                print $_POST['choice'];
                break;
        }
    }

    public function __toString()
    {
        if ( sizeof($_POST) > 0 )
            $this->set($_POST);

        $this->block("checked{$this->cheched}")->end();

        parent::__toString();
    }
}