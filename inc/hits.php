<?php

class Hits
{
    public static function save()
    {
        if ( strncmp(Web::getIP(), '10.0.0.', 7) != 0 )
        {
            Db::insert('hits', array(
                'client_ip'   => Web::getIP(),
                'user_agent'  => Web::getUserAgent(),
                'request_uri' => Web::getRequestUri(),
                'time'        => time()
            ));
        }
    }
}