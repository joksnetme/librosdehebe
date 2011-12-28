<?php

function camelCase( $str, $lowerFirst = true )
{
    # $chars = explode('', $str);
    $spaces = array(' ', '_', '-', '+');

    $camelCase = '';
    $toUpper = false;

    # foreach ( $chars as $char )
    for ( $i = 0, $l = strlen($str); $i < $l; $i++ )
    {
        $char = substr($str, $i, 1);
        $ord = ord($char);

        if ( ( $ord >= 65 && $ord <= 90 ) || ( $ord >= 97 && $ord <= 122 ) || ( $ord >= 48 && $ord <= 57 ) )
        {
            if ( $toUpper )
                $char = strtoupper($char);
            else
                $char = strtolower($char);

            $camelCase .= $char;
            $toUpper = false;
        }
        elseif ( in_array($char, $spaces) )
            $toUpper = true;
    }

    if ( $lowerFirst )
        $camelCase = strtolower( substr($camelCase, 0, 1) ) . substr($camelCase, 1);
    else
        $camelCase = strtoupper( substr($camelCase, 0, 1) ) . substr($camelCase, 1);

    return $camelCase;
}

function textFormat( $pee )
{
    $br = true;

    $pee = $pee . "\n"; // just to make things a little easier, pad the end
    $pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);

    // Space things out a little
    $allblocks = '(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr)';
    $pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
    $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);

    $pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines

    if ( strpos($pee, '<object') !== false )
    {
        $pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
        $pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
    }

    $pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
    $pee = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "<p>$1</p>\n", $pee); // make paragraphs, including one at the end
    $pee = preg_replace('|<p>\s*?</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
    $pee = preg_replace('!<p>([^<]+)\s*?(</(?:div|address|form)[^>]*>)!', "<p>$1</p>$2", $pee);
    $pee = preg_replace( '|<p>|', "$1<p>", $pee );
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
    $pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
    $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
    $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

    if ( $br )
    {
        $pee = preg_replace('/<(script|style).*?<\/\\1>/se', 'str_replace("\n", "<PreserveNewline />", "\\0")', $pee);
        $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
        $pee = str_replace('<PreserveNewline />', "\n", $pee);
    }

    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
    $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);

    if ( strpos($pee, '<pre') !== false )
        $pee = preg_replace_callback('!(<pre.*?>)(.*?)</pre>!is', 'cleanPre', $pee);

    $pee = preg_replace("|\n</p>$|", '</p>', $pee);

    return $pee;
}

function textWiki( $str )
{
    $str = htmlspecialchars( $str );

    $url = '(?:ftp|https?):\/\/(?:\w+:{0,1}\w*@)?(?:\S+)(?:[0-9]+)?(?:\/|\/(?:[\w#!:.?+=&%@!\-\/]))?';
    $img = $url . '\.(gif|jpg|png|jpeg|tif|bmp)';

    # Url + Image
    $str = preg_replace("~\[($url)\|($img)\]~",  '<a href="$1"><img src="$2" alt="" /></a>', $str);
    $str = preg_replace("~\[\s($url)\|($img)\]~", '<a href="$1" style="float: right;"><img src="$2" alt="" /></a>', $str);
    $str = preg_replace("~\[($url)\|($img)\s\]~", '<a href="$1" style="float: left;"><img src="$2" alt="" /></a>', $str);

    # Url + Text
    $str = preg_replace("~\[(($url)\|(.+?))\]~", '<a href="$2">$3</a>', $str);

    # Image
    $str = preg_replace("~\[($img)\]~",  '<img src="$1" alt="" />', $str);
    $str = preg_replace("~\[\s($img)\]~", '<img src="$1" alt="" style="float: right;" />', $str);
    $str = preg_replace("~\[($img)\s\]~", '<img src="$1" alt="" style="float: left;" />', $str);

    # Url
    $str = preg_replace("~\[($url)\]~", '<a href="$1">$1</a>', $str);

    # Headings
    $str = preg_replace('/======\s([^<^>]+)?\s======/', '{beginH6}$1{endH6}', $str);
    $str = preg_replace('/=====\s([^<^>]+)?\s=====/', '{beginH5}$1{endH5}', $str);
    $str = preg_replace('/====\s([^<^>]+)?\s====/', '{beginH4}$1{endH4}', $str);
    $str = preg_replace('/===\s([^<^>]+)?\s===/', '{beginH3}$1{endH3}', $str);
    $str = preg_replace('/==\s([^<^>]+)?\s==/', '{beginH2}$1{endH2}', $str);
    $str = preg_replace('/=\s([^<^>]+)?\s=/', '{beginH1}$1{endH1}', $str);

    # Bold + Underline + Italic
    $str = preg_replace('/\*([^\*^<^>]+){1,}?\*/', '{beginBold}$1{endSpan}', $str);
    $str = preg_replace('/\_([^\_^<^>]+){1,}?\_/', '{beginUnderline}$1{endSpan}', $str);
    $str = preg_replace('/\/([^\/^<^>]+){1,}?\//', '{beginItalic}$1{endSpan}', $str);

    $str = str_replace(
        array( '{beginBold}', '{beginUnderline}', '{beginItalic}', '{endSpan}', '{beginH1}', '{beginH2}', '{beginH3}', '{beginH4}', '{beginH5}', '{beginH6}', '{endH1}', '{endH2}', '{endH3}', '{endH4}', '{endH5}', '{endH6}' ),
        array( '<span style="font-weight: bold;">', '<span style="text-decoration: underline;">', '<span style="font-style: italic;">', '</span>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>' ), $str
    );

    return textFormat($str);
}

function thumbnail( $baseDir, $fileName, $roman, $extension, $delete = false )
{
    if ( !( is_dir($baseDir) ) )
        @mkdir($baseDir, 0777);

    if ( !( is_dir("$baseDir/250x330") ) )
        @mkdir("$baseDir/250x330", 0777);

    if ( !( is_dir("$baseDir/190x255") ) )
        @mkdir("$baseDir/190x255", 0777);

    if ( !( is_dir("$baseDir/120x160") ) )
        @mkdir("$baseDir/120x160", 0777);

    if ( !( is_dir("$baseDir/75x100") ) )
        @mkdir("$baseDir/75x100", 0777);

    DefinedImage::load($fileName)

    ->resize(250, 330)
    ->save("$baseDir/250x330/$roman.$extension")

    ->resize(190, 255)
    ->save("$baseDir/190x255/$roman.$extension")

    ->resize(120, 160)
    ->save("$baseDir/120x160/$roman.$extension")

    ->resize(75, 100)
    ->save("$baseDir/75x100/$roman.$extension")

    ->original("$baseDir/$roman.$extension");

    if ( $delete )
        @unlink($fileName);
}

function buscarURI( $values )
{
    $keys = array( 'titulo', 'autor', 'anho', 'editorial', 'keywords' );
    $keysI = 0;

    foreach ( $keys as $key )
    {
        if ( isset($values[$key]) && strlen($values[$key]) )
        {
            $value = $values[$key];

            $uri .= str_repeat('+', $keysI) . trim( urlencode($value) ) . '/';
            $keysI = 0;
        }
        else
            $keysI++;
    }

    return $uri;
}

function toRoman( $num, $toLower = true )
{
    if ( $num < 0 || $num > 9999 ) { return -1; }

    $rOnes = array( 1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX');
    $rTens = array( 1 => 'X', 2 => 'XX', 3 => 'XXX', 4 => 'XL', 5 => 'L', 6 => 'LX', 7 => 'LXX', 8 => 'LXXX', 9 => 'XC');
    $rHund = array( 1 => 'C', 2 => 'CC', 3 => 'CCC', 4 => 'CD', 5 => 'D', 6 => 'DC', 7 => 'DCC', 8 => 'DCCC', 9 => 'CM');
    $rThou = array( 1 => 'M', 2 => 'MM', 3 => 'MMM', 4 => 'MMMM', 5 => 'MMMMM', 6 => 'MMMMMM', 7 => 'MMMMMMM', 8 => 'MMMMMMMM', 9 => 'MMMMMMMMM');

    $ones = $num % 10;
    $tens = ($num - $ones) % 100;
    $hundreds = ($num - $tens - $ones) % 1000;
    $thou = ($num - $hundreds - $tens - $ones) % 10000;

    $tens = $tens / 10;
    $hundreds = $hundreds / 100;
    $thou = $thou / 1000;

    if ( $thou ) { $rNum .= $rThou[$thou]; }
    if ( $hundreds ) { $rNum .= $rHund[$hundreds]; }
    if ( $tens ) { $rNum .= $rTens[$tens]; }
    if ( $ones ) { $rNum .= $rOnes[$ones]; }

    if ( $toLower )
        return strtolower($rNum);

    return $rNum;
}

function reOrderImages( $idLibros, $path = false )
{
    $path   = $path ? $path : "upl/libros/$idLibros/";
    $dir    = opendir($path);

    $levels = array('.', '..');
    $files  = array();

    while ( $file = readdir($dir)  )
    {
        if ( !in_array($file, $levels) )
        {
            if ( is_dir($path . $file) )
                reOrderImages($idLibros, $path . $file . "/");

            elseif ( is_file($path . $file) )
            {
                $roman  = str_replace('.jpg', '', $file);
                $files[roman2dec($roman)] = $path . $file;
            }
        }
    }

    $keys = array_keys($files); sort($keys);
    $x = 1;

    foreach ( $keys as $n )
    {
        // Renombrar de toRoman($n).jpg a toRoman($x).jpg
        rename($path . toRoman($n) . '.jpg', $path . toRoman($x) . '.jpg');

        $x++;
    }

    closedir($dir);
}

function roman2dec( $rom )
{
    $rom    = strtoupper($rom);

    $digits = array(
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000
    );

    $retval = '';
    $chars  = array();

    for ( $i = 1; $i <= strlen($rom); $i++ )
        $chars[] = substr($rom, $i - 1, 1);

    $step = 1;

    for ( $i = count($chars) - 1; $i >= 0; $i-- )
    {
        if ( !isset($digits[$chars[$i]]))
            return 'Error!';

        if ( $step <= $digits[$chars[$i]])
        {
            $step    = $digits[$chars[$i]];
            $retval += $digits[$chars[$i]];
        }
        else
            $retval -= $digits[$chars[$i]];
    }

    return $retval;
}

function getCompraPrecio( $idCompras, $idUsuarios, $ofertar = false, $cantidades = false )
{
    $result = Db::query(
        "SELECT carrito.oferta
              , carrito.cantidad
              , libros.precio AS libroPrecio
              , envios.precio AS envioPrecio
           FROM compras
     INNER JOIN envios
             ON envios.id_envios = compras.id_envios
     INNER JOIN compras_items
             ON compras_items.id_compras = compras.id_compras
     INNER JOIN carrito
             ON carrito.id_carrito = compras_items.id_carrito
     INNER JOIN libros
             ON libros.id_libros = carrito.id_libros
          WHERE compras.id_compras = '$idCompras'
            AND compras.id_usuarios = '$idUsuarios'"
    );

    $precioTotal = $result[0]['envioPrecio'];

    foreach ( $result as $value )
    {
        $precio       = $value['oferta'] > 0 && $ofertar ? $value['oferta']: $value['libroPrecio'];
        $cantidad     = $value['cantidad'] > 1 && $cantidades ? $value['cantidad'] : 1;
        $precioTotal += $precio * $cantidad;
    }
    
    return $precioTotal;
}