<?php

include_once "$root/inc/json.php";
include_once "$root/inc/template.php";

include_once "$root/inc/web.php";
include_once "$root/inc/db.php";

include_once "$root/inc/constants.php";
include_once "$root/inc/functions.php";
include_once "$root/inc/cookies.php";
include_once "$root/inc/validation.php";

include_once "$root/inc/hits.php";
include_once "$root/inc/user.php";

session_start();

Db::open($dbConfig); Hits::save();
Cookies::$prefix = 'LibrosDeHebe_';

/*
if ( $data = Db::query('SELECT name, value FROM config') )
    $config = $data;
else
    $config = array();
*/

/*
function fixMagicQuotes( &$array )
{
    foreach ( $array as $key => $value )
    {
        if ( is_array( $value ) )
            fixMagicQuotes($array[$key]);
        else
            $array[$key] = stripslashes($value);
    }

    return $array;
}

if ( get_magic_quotes_gpc() )
{
    fixMagicQuotes($_COOKIE);
    fixMagicQuotes($_ENV);
    fixMagicQuotes($_GET);
    fixMagicQuotes($_POST);
    fixMagicQuotes($_REQUEST);
    fixMagicQuotes($_SERVER);
}
*/