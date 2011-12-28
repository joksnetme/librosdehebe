<?php

class Newsletter
{
    public function __onSubmit()
    {
        $result = Db::insert('newsletter', array(
            'email' => $_POST['email']
        ));

        header('Location: /');
    }
}