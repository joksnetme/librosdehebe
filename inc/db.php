<?php

class Db
{
    public static $num = 0;

    protected static $db = null;

    public static function open( $config )
    {
        self::$db = @mysql_connect(
            $config['hostname'],
            $config['username'],
            $config['password']
        );

        if ( self::$db )
            @mysql_select_db($config['database']);
    }

    public static function close()
    {
        if ( self::ready() )
            @mysql_close(self::$db);
    }

    public static function ready()
    {
        return ( self::$db ) ? true : false;
    }

    public static function update( $table, $fields, $where )
    {
        $set = array();

        foreach ( $fields as $name => $value )
            $set[] = "$name = '$value'";

        return self::query("UPDATE $table SET " . implode(', ', $set) . " WHERE $where");
    }

    public static function insert( $table, $fields )
    {
        $names = array_keys($fields);
        $values = array_map( create_function('$s', 'return "\'$s\'";'), array_values($fields) );

        return self::query("INSERT INTO $table ( " . implode(', ', $names) . " ) VALUES ( " . implode(', ', $values) . " )");
    }

    public static function delete( $table, $where )
    {
        return self::query("DELETE FROM $table WHERE $where");
    }

    public static function count( $table, $where )
    {
        $count = self::query("SELECT COUNT(*) AS count FROM $table WHERE $where", false);

        if ( $count )
        {
            $count = array_shift($count);
            $count = $count['count'];

            return $count;
        }

        return 0;
    }

    public static function query( $sql )
    {
        $data = null;

        if ( !( $result = @mysql_query($sql) ) ){
            var_dump(mysql_error());
            return false;
        }

        self::$num = @mysql_num_rows($result);

        if ( strncmp($sql, 'SELECT', 6) == 0 )
        {
            $data = array();

            /**
            if ( self::$num == 1 && $assoc )
            {
                $data = @mysql_fetch_assoc($result);

                if ( sizeof($data) == 1 )
                {
                    $tmpk = array_values($data);
                    $data = $tmpk[0];
                }
            }
            else
             */
            {
                while ( $row = @mysql_fetch_assoc($result) )
                {
                    /**
                    if ( $assoc )
                    {
                        $fc = array_slice($row, 0, 1);
                        $tmpk = array_keys($fc);
                        $tmpv = array_values($fc);

                        unset($row[$tmpk[0]]);

                        if ( sizeof($row) == 1 )
                            $data[$tmpv[0]] = array_pop($row);
                        else
                            $data[$tmpv[0]] = $row;
                    }
                    else
                     */
                        $data[] = $row;
                }
            }
        }
        elseif ( strncmp($sql, 'INSERT', 6) == 0 )
        {
            $data = @mysql_insert_id();
        }
        elseif ( strncmp($sql, 'UPDATE', 6) == 0 )
        {
            $data = @mysql_affected_rows();
        }

        @mysql_free_result($result);

        if ( $data !== null )
            return $data;
        else
            return true;
    }
}