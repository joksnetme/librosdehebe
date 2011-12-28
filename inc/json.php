<?php

class Json
{
    public static function encode( $value )
    {
        if ( function_exists('json_encode') )
            return json_encode($value);

        return Json_Encoder::encode($value);
    }
}

class Json_Encoder
{
    public static function encode( $value )
    {
        return self::_encodeValue($value);
    }

    private static function _encodeValue( &$value )
    {
        if ( is_object($value) )
            return self::_encodeObject($value);
        elseif ( is_array($value) )
            return self::_encodeArray($value);

        return self::_encodeData($value);
    }

    private static function _encodeObject( &$object )
    {
        $className = get_class($object);
        $properties = '';

        foreach ( get_object_vars($value) as $name => $propValue )
        {
            if ( isset($propValue) )
            {
                $properties .= ','
                             . self::_encodeValue($name)
                             . ':'
                             . self::_encodeValue($propValue);
            }
        }

        return sprintf('{"__className":"%s"%s}'
            , $className
            , $properties
        );
    }

    private static function _encodeArray( &$array )
    {
         $tmpArray = array();

        if ( !empty($array) && ( array_keys($array) !== range(0, count($array) - 1) ) )
        {
            // Associative array
            $result = '{';

            foreach ( $array as $key => $value )
            {
                $key = (string) $key;
                $tmpArray[] = self::_encodeString($key)
                            . ':'
                            . self::_encodeValue($value);
            }

            $result .= implode(',', $tmpArray);
            $result .= '}';
        }
        else
        {
            // Indexed array
            $result = '[';
            $length = count($array);

            for ( $i = 0; $i < $length; $i++ )
                $tmpArray[] = self::_encodeValue($array[$i]);

            $result .= implode(',', $tmpArray);
            $result .= ']';
        }

        return $result;
    }

    private static function _encodeData( &$value )
    {
        $result = 'null';

        if ( is_int($value) || is_float($value) )
            $result = (string) $value;
        elseif ( is_string($value) )
            $result = self::_encodeString($value);
        elseif ( is_bool($value) )
            $result = ( $value ) ? 'true' : 'false';

        return $result;
    }

    private static function _encodeString( &$string )
    {
        // Escape these characters with a backslash:
        // " \ / \n \r \t \b \f
        $search  = array('\\', "\n", "\t", "\r", "\b", "\f", '"');
        $replace = array('\\\\', '\\n', '\\t', '\\r', '\\b', '\\f', '\"');
        $string  = str_replace($search, $replace, $string);

        // Escape certain ASCII characters:
        // 0x08 => \b
        // 0x0c => \f
        $string = str_replace(array(chr(0x08), chr(0x0C)), array('\b', '\f'), $string);

    	return '"' . $string . '"';
    }
}