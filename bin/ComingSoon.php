<?php

class ComingSoon
{
    public $type = 'text/html';

    public function __toScreen()
    {
        global $root;

        $tpl = new Template("$root/tpl");
        $tpl->set_filenames(array( 'comingsoon' => 'ComingSoon.tpl' ));
        $tpl->pparse('comingsoon');
    }
}