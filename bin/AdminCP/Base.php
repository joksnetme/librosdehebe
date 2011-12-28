<?php

include_once "$root/bin/Base.php";

class AdminCP_Base extends Base
{
    protected $login = false;
    protected $user = array();

    public function __construct( $title = null )
    {
        if ( is_null($title) )
            $title = 'Panel de Control';
        else
        {
            if ( is_array($title) )
                $title = implode(' &raquo; ', $title);

            $title = "Panel de Control &raquo; $title";
        }

        parent::__construct($title, null, '/AdminCP/');

        if ( !( $this->user->login ) )
            Web::redirect('/login/');

        if ( !( $this->user->admin ) )
            Web::redirect('/usercp/');

        $this->nav('Panel de Control');
    }

    public function specialchars( $block = '' )
    {
        if ( !( $this->isModulo(MODULOS_SPECIALCHARS) ) )
            return;

        if ( strlen($block) > 0 )
            $block .= '.';

        // $specialchars = get_html_translation_table(HTML_ENTITIES);
        $specialchars = array(
            'aacute', 'eacute', 'iacute', 'oacute', 'uacute',
            'Aacute', 'Eacute', 'Iacute', 'Oacute', 'Uacute',
            'ntilde', 'Ntilde', 'ccedil', 'Ccedil',
            'copy', 'reg', 'trade', 'cent', 'euro', 'pound', 'yen'
        );

        $this->block("specialchars")->end();

        if ( strlen($block) > 0 )
            $this->block("{$block}specialchars")->end();

        foreach ( $specialchars as $char => $code )
        {
            $extras = ( strpos($code, 'acute') !== false || strpos($code, 'tilde') !== false )
                    ? 'char' : 'char extras hidden';

            $this->block("{$block}specialchars.each")
                 ->set('char', $code)
                 ->set('code', "&$code;")
                 ->set('class', $extras)
                 ->end();
        }
    }
}