<?php

class Web
{
    public static $errors = array();

    public static function getIP()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public static function getRequestUri()
    {
        $requestUri = '';

        if ( isset($_SERVER['HTTP_X_REWRITE_URL']) )
            $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
        elseif ( isset($_SERVER['REQUEST_URI']) )
            $requestUri = $_SERVER['REQUEST_URI'];
        elseif ( isset($_SERVER['ORIG_PATH_INFO']) )
        {
            $requestUri = $_SERVER['ORIG_PATH_INFO'];

            if ( !( empty($_SERVER['QUERY_STRING']) ) )
                $requestUri .= '?' . $_SERVER['QUERY_STRING'];
        }

        return $requestUri;
    }

    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public static function redirect( $url )
    {
        header("Location: $url");
    }

    public static function dispatch( $urls )
    {
        global $root;

        $found = false;
        $requestUri = self::getRequestUri();
        $isPost = self::isPost();
        $phpsesid = '(?:\?PHPSESSID=\w+)?$';

        foreach ( $urls as $url => $name )
        {
            $fn = str_replace('_', '/', $name);
            
            if ( substr($url, -1) == '$' )
                $url = substr($url, 0, -1) . $phpsesid;
            else 
                $url .= $phpsesid;
            
            if ( preg_match("~$url~", $requestUri, $params) )
            {
                array_shift($params);

                if ( $found = self::exec($name, $fn, $params) )
                    break;
            }
        }

        if ( !( $found ) )
        {
            header('HTTP/1.0 404 Not Found');

            if ( isset(self::$errors['404']) )
                self::exec( self::$errors['404'] );
        }
    }

    protected static function exec( $name, $fn = null, $params = array() )
    {
        global $root;

        if ( is_null($fn) )
            $fn = str_replace('_', '/', $name);

        if ( is_readable("$root/bin/$fn.php") )
        {
            include_once "$root/bin/$fn.php";

            if ( class_exists($name) )
            {
                $controller = new $name($params);

                if ( $controller->type && !( empty($controller->type) ) && !( headers_sent() ) )
                    header('Content-Type: ' . $controller->type);

                if ( self::isPost() && method_exists($controller, '__onSubmit') )
                    $controller->__onSubmit();

                if ( method_exists($controller, '__toString') )
                    echo $controller->__toString();

                if ( method_exists($controller, '__toScreen') )
                    $controller->__toScreen();

                return true;
            }
        }

        return false;
    }
}