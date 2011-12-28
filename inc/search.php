<?php

class Search
{
    protected $mode = self::MODE_LIBROS;
    protected $useSynonyms = true;
    protected $synonym = null;

    const MODE_LIBROS = 0;
    const MODE_SEARCH = 1;
    const MODE_SINGLE = 2;

    public function __construct( $mode = self::MODE_LIBROS, $useSynonyms = true )
    {
        if ( $useSynonyms )
        {
            $results = Db::query(
                "SELECT sinonimos.id_sinonimos
                      , sinonimos.palabra
                      , sinonimos.sinonimo
                 FROM sinonimos"
            );

            foreach ( (array) $results as $row )
                $this->synonym[$row['palabra']] = $row['sinonimo'];
        }

        $this->mode = $mode;
        $this->useSynonyms = $useSynonyms;
    }

    public function add( $idLibros, $fields )
    {
        $rawWords = array();

        foreach ( $fields as $fieldName => $fieldValue )
            $rawWords[$fieldName] = $this->split( $this->clean($fieldValue) );

        @set_time_limit(0);

        $word = array();
        $wordInsertSQL = array();

        while ( list($wordIn, $matches) = @each($rawWords) )
        {
            $wordInsertSQL[$wordIn] = '';

            if ( !( empty($matches) ) )
            {
                for ( $i = 0, $l = count($matches); $i < $l; $i++ )
                {
                    $matches[$i] = trim($matches[$i]);

                    if ( $matches[$i] != '' )
                    {
                        $word[] = $matches[$i];

                        if ( !( strstr($wordInsertSQL[$wordIn], "'" . $matches[$i] . "'") ) )
                            $wordInsertSQL[$wordIn] .= ( $wordInsertSQL[$wordIn] != "" ) ? ", '" . $matches[$i] . "'" : "'" . $matches[$i] . "'";
                    }
                }
            }
        }

        if ( count($word) )
        {
            sort($word);

            $wordPrev = '';
            $wordTextSQL = '';
            $wordTemp = array();

            for ( $i = 0, $l = count($word); $i < $l; $i++ )
            {
                if ( $word[$i] != $wordPrev )
                {
                    $wordTemp[] = $word[$i];
                    $wordTextSQL .= ( ( $wordTextSQL != '' ) ? ', ' : '' ) . "'" . $word[$i] . "'";
                }

                $wordPrev = $word[$i];
            }

            $word = $wordTemp;
            $wordsChecks = array();

            $result = Db::query(
                "SELECT palabras.id_palabras
                      , palabras.palabra
                 FROM palabras
                 WHERE palabras.palabra IN ( $wordTextSQL )"
            );

            foreach ( (array) $result as $row )
                $wordsChecks[$row['palabra']] = $row['id_palabras'];

            $valueSQL = '';
            $wordMatch = array();

            for ( $i = 0, $l = count($word); $i < $l; $i++ )
            {
                $newMatch = true;

                if ( isset($wordsChecks[$word[$i]]) )
                    $newMatch = false;

                if ( $newMatch )
                    $valueSQL .= ( ( $valueSQL != '' ) ? ', ' : '' ) . '(\'' . $word[$i] . '\', 0)';
            }

            if ( $valueSQL != '' )
            {
                Db::query(
                    "INSERT IGNORE INTO palabras ( palabra, comun )
					 VALUES $valueSQL"
                );
            }
        }

        while( list($wordIn, $matchSQL) = @each($wordInsertSQL) )
        {
            if ( $matchSQL != '' )
            {
                Db::query(
                    "INSERT INTO palabras_relaciones ( id_libros, id_palabras, campo )
                     SELECT $idLibros, id_palabras, '$wordIn'
                     FROM palabras
                     WHERE palabra IN ( $matchSQL )"
                );
            }
        }

        if ( $this->mode == self::MODE_SINGLE )
            $this->removeCommon(4/10, $word);
    }

    public function remove( $idLibros )
    {
        $result = Db::query(
            "SELECT r.id_palabras
             FROM palabras_relaciones r
             WHERE r.id_libros = '$idLibros'"
        );

        if ( $result )
        {
            foreach ( $result as $row )
            {
                $idPalabras = $row['id_palabras'];
                $count = Db::query(
                    "SELECT COUNT(*) AS total
                     FROM palabras_relaciones
                     WHERE id_palabras = '$idPalabras'
                       AND id_libros <> '$idLibros'"
                );

                if ( $count && $count[0]['total'] > 0 )
                {
                    /**
                     * Esta palabra esta relacionada con otros libros.
                     * Entonces no la elimino.
                     */
                }
                else
                {
                    Db::query(
                        "DELETE FROM palabras
                         WHERE id_palabras = '$idPalabras'"
                    );
                }
            }

            Db::query(
                "DELETE FROM palabras_relaciones
                 WHERE id_libros = '$idLibros'"
            );
        }
    }

    protected function removeCommon( $fraction, $wordId = array() )
    {
        static $total = null;

        if ( null === $total )
            $total = Db::count('libros', '1');

        if ( $total >= 100 )
        {
            $commonThreshold = floor($total * $fraction);

            if ( $this->mode == self::MODE_SINGLE && count($wordId) )
            {
                $wordIdSQL = '';

                for ( $i = 0, $l = count($wordId); $i < $l; $i++ )
                    $wordIdSQL .= ( ( $wordIdSQL != '' ) ? ', ' : '' ) . "'" . $wordId[$i] . "'";

                $result = Db::query(
                    "SELECT palabras_relaciones.id_palabras
                     FROM palabras_relaciones, palabras
                     WHERE palabras.palabra IN ( $wordIdSQL )
                       AND palabras_relaciones.id_palabras = palabras.id_palabras
                     GROUP BY palabras_relaciones.id_palabras
                     HAVING COUNT(palabras_relaciones.id_palabras) > $commonThreshold"
                );
            }
            else
            {
                $result = Db::query(
                    "SELECT palabras_relaciones.id_palabras
                     FROM palabras_relaciones
                     GROUP BY palabras_relaciones.id_palabras
                     HAVING COUNT(palabras_relaciones.id_palabras) > $commonThreshold"
                );
            }

            $commonWordId = '';

            foreach ( (array) $result as $row )
                $commonWordId .= ( ( $commonWordId != '' ) ? ', ' : '' ) . $row['id_palabras'];

            if ( $commonWordId != '' )
            {
                Db::update('palabras', array( 'comun' => 1 ), "id_palabras IN ( $commonWordId )");
                Db::delete('palabras_relaciones', "id_palabras IN ( $commonWordId )");
            }
        }

        return;
    }

    public function split( $entry )
    {
        // If you experience problems with the new method, uncomment this block.
        /**
         * $rex = ( $mode == 'post' ) ? "/\b([\w±µ-ÿ][\w±µ-ÿ']*[\w±µ-ÿ]+|[\w±µ-ÿ]+?)\b/" : '/(\*?[a-z0-9±µ-ÿ]+\*?)|\b([a-z0-9±µ-ÿ]+)\b/';
         * preg_match_all($rex, $entry, $split_entries);
         *
         * return $split_entries[1];
         */

        // Trim 1+ spaces to one space and split this trimmed string into words.
        return explode(' ', trim(preg_replace('#\s+#', ' ', $entry)));
    }

    public function clean( &$entry )
    {
        static $dropCharMatch   = array('^', '$', '&', '(', ')', '<', '>', '`', '\'', '"', '|', ',', '@', '_', '?', '%', '-', '~', '+', '.', '[', ']', '{', '}', ':', '\\', '/', '=', '#', '\'', ';', '!', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü', 'ç', 'Ç');
        static $dropCharReplace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', '',  '',   ' ', ' ', ' ', ' ', '',  ' ', ' ', '',  ' ',  ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ',  ' ', ' ', 'n', 'N', 'a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'u', 'U', 'c', 'C');

        if ( detectUTF8($entry) )
            $entry = utf8_decode($entry);

        if ( $this->mode == self::MODE_LIBROS )
        {
            // Replace line endings by a space
            $entry = preg_replace('/[\n\r]/is', ' ', $entry);

            // HTML entities like &nbsp;
            $entry = preg_replace('/\b&[a-z]+;\b/', ' ', $entry);

            // Remove URL's
            $entry = preg_replace('/\b[a-z0-9]+:\/\/[a-z0-9\.\-]+(\/[a-z0-9\?\.%_\-\+=&\/]+)?/', ' ', $entry);
        }
        elseif ( $this->mode == self::MODE_SEARCH )
        {
            # $entry = str_replace(' +', ' and ', $entry);
            # $entry = str_replace(' -', ' not ', $entry);
        }

        //
        // Filter out strange characters like ^, $, &, change "it's" to "its"
        //
        for ( $i = 0; $i < count($dropCharMatch); $i++ )
            $entry = str_replace($dropCharMatch[$i], $dropCharReplace[$i], $entry);

        if ( $this->mode == self::MODE_LIBROS )
        {
            $entry = str_replace('*', ' ', $entry);

            // 'words' that consist of <3 or >20 characters are removed.
            $entry = preg_replace('/[ ]([\S]{1,2}|[\S]{21,})[ ]/',' ', $entry);
        }

        if ( $this->useSynonyms )
        {
            foreach ( $this->synonym as $palabra => $sinonimo )
            {
                if ( $this->mode == self::MODE_LIBROS || ( $palabra != 'not' && $palabra != 'and' && $palabra != 'or' ) )
                    $entry = str_replace(' ' . trim($palabra) . ' ', ' ' . trim($sinonimo) . ' ', $entry);
            }
        }

        return $entry;
    }
}

function detectUTF8( $string )
{
    return preg_match('%(?:
        [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
        |\xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
        |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
        |\xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
        |\xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
        |[\xF1-\xF3][\x80-\xBF]{3}         # planes 4-15
        |\xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
        )+%xs', $string
    );
}

function indexarLibro( $idLibros, $isbn = true, $sinopsis = true, $useSynonyms = true )
{
    $isbn = ( $isbn ) ? ', libros.isbn' : '';
    $sinopsis = ( $sinopsis ) ? ', libros_sinopsis.sinopsis' : '';

    $result = Db::query(
        "SELECT libros.id_libros
              {$isbn}
              , libros.titulo
              , libros.anho
              {$sinopsis}
              , autores.nombre AS autor
              , editoriales.nombre AS editorial
              , colecciones.nombre AS coleccion
         FROM libros
         LEFT JOIN libros_sinopsis
                ON libros_sinopsis.id_libros = libros.id_libros
         INNER JOIN autores
                 ON autores.id_autores = libros.id_autores
         INNER JOIN editoriales
                 ON editoriales.id_editoriales = libros.id_editoriales
          LEFT JOIN colecciones
                 ON colecciones.id_colecciones = libros.id_colecciones
         WHERE libros.id_libros = '$idLibros'"
    );

    if ( $result )
    {
        $libro = $result[0]; unset($libro['id_libros']);

        $search = new Search(Search::MODE_SINGLE, $useSynonyms);
        $search->remove($idLibros);
        $search->add($idLibros, $libro);

        return true;
    }

    return false;
}

function search( $values, $minChars = 3, $useSynonyms = true )
{
    $search = new Search(
        Search::MODE_SEARCH, $useSynonyms
    );

    //
    // encoding match for workaround
    //
    // $multibyteCharset = 'utf-8, big5, shift_jis, euc-kr, gb2312';

    $resultList = array();
    $wordCount = 0;

    foreach ( $values as $name => $keywords )
    {
        $currentMatchType = 'and';
        $sqlField = '';

        if ( $name != 'keywords' )
            $sqlField = "AND r.campo = '$name'";

        $keywordsStripped = stripslashes($keywords);
        $keywordsSearch = $search->split( $search->clean($keywordsStripped) );

        /**
         * $keywordsSearch = ( !( strstr($multibyteCharset, $this->encoding) ) )
         *     ? $search->split( $search->clean($keywordsStripped) )
         *     : explode(' ', $keywords);
         */

        unset($keywordsStripped);

        for ( $i = 0, $l = count($keywordsSearch); $i < $l; $i++ )
        {
            switch ( strtolower( $keywordsSearch[$i] ) )
            {
                case 'and':
                    $currentMatchType = 'and';
                    break;

                case 'or':
                    $currentMatchType = 'or';
                    break;

                case 'not':
                    $currentMatchType = 'not';
                    break;

                default:
                    if ( strlen( str_replace( array('*', '%'), '', trim($keywordsSearch[$i]) ) ) < $minChars )
                    {
                        $keywordsSearch[$i] = ''; continue;
                    }

                    if ( $name == 'anho' && strpos($keywordsSearch[$i], 'a') !== false )
                    {
                        list($anho_d, $anho_h) = explode('a', $keywordsSearch[$i]);

                        $sql = "SELECT r.id_libros
                                FROM palabras p
                                   , palabras_relaciones r
                                WHERE p.palabra >= '$anho_d'
                                  AND p.palabra < '$anho_h'
                                AND p.id_palabras = r.id_palabras
                                AND p.comun <> 1
                                AND r.campo = 'anho'";
                    }
                    else
                    // if ( !( strstr($multibyteCharset, $this->encoding) ) )
                    // if ( 1 )
                    {
                        $wordMatchStr = strtolower( str_replace('*', '%', $keywordsSearch[$i]) );
                        $sql = "SELECT r.id_libros
                                FROM palabras p
                                   , palabras_relaciones r
                                WHERE LCASE(p.palabra) LIKE '$wordMatchStr'
                                AND p.id_palabras = r.id_palabras
                                AND p.comun <> 1
                                $sqlField";
                    }
                    /**
                     * else
                     * {
                     *     $wordMatchStr =  addslashes('%' . str_replace('*', '', $keywordsSearch[$i]) . '%');
                     *
                     *     $sqlField = '';
                     *     $sql = "SELECT id_libros
                     *             FROM libros
                     *             INNER JOIN autores
                     *                     ON autores.id_autores = libros.id_autores
                     *             INNER JOIN editoriales
                     *                     ON editoriales.id_editoriales = libros.id_editoriales
                     *             WHERE LCASE(libros.isbn) LIKE '$wordMatchStr'
                     *                OR LCASE(libros.titulo) LIKE '$wordMatchStr'
                     *                OR LCASE(libros.anho) LIKE '$wordMatchStr'
                     *                OR LCASE(autores.nombre) LIKE '$wordMatchStr'
                     *                OR LCASE(editoriales.nombre) LIKE '$wordMatchStr'";
                     * }
                     */

                    $result = Db::query($sql);

                    if ( !( $result ) )
                        return false; // Web::redirect("/buscar/error/");

                    $row = array();

                    foreach ( $result as $rowTmp )
                    {
                        $row[$rowTmp['id_libros']] = 1;

                        if ( !( $wordCount ) )
                            $resultList[$rowTmp['id_libros']] = 1;
                        else if ( $currentMatchType == 'or' )
                            $resultList[$rowTmp['id_libros']] = 1;
                        else if ( $currentMatchType == 'not' )
                            $resultList[$rowTmp['id_libros']] = 0;
                    }

                    if ( $currentMatchType == 'and' && $wordCount )
                    {
                        @reset($resultList);

                        while( list($idLibros, $wordMatchCount) = @each($resultList) )
                        {
                            if ( !( $row[$idLibros] ) )
                                $resultList[$idLibros] = 0;
                        }
                    }

                    $wordCount++;
                    break;
            }
        }
    }

    @reset($resultList);

    while( list($idLibros, $matches) = each($resultList) )
        if ( $matches )
            $searchIds[] = $idLibros;

    return $searchIds;
}