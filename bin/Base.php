<?php

define('MODULOS_BUSCAR_JAVASCRIPT', 'buscar_javascript');
define('MODULOS_BUSCAR_SINONIMOS', 'buscar_sinonimos');
define('MODULOS_BUSCAR_RANGOANHO', 'buscar_rangoanho');
define('MODULOS_SPECIALCHARS', 'specialchars');
define('MODULOS_LIBROS_COLECCIONES', 'libros_colecciones');
define('MODULOS_LIBROS_OFERTAR', 'libros_ofertar');
define('MODULOS_LIBROS_CANTIDADES', 'libros_cantidades');

class Base
{
    public $type = 'text/plain';

    /**
     * @var Template
     */
    private $tpl;

    private $block = null;
    private $blockVars = array();
    private $vars = array();

    /**
     * @var Validation
     */
    private $validation;
    private $validationFlag = false;

    /**
     * @var User
     */
    protected $user;

    public function __construct( $title = null, $fileName = null, $rootTpl = '' )
    {
        global $root;

        if ( is_null($fileName) )
        {
            $fileName = get_class($this);

            if ( strpos($fileName, '_') !== false )
            {
                $fileNameParts = explode('_', $fileName);
                $fileName = array_pop($fileNameParts);
            }
        }

        if ( substr($fileName, -4) != '.tpl' )
            $fileName .= '.tpl';

        if ( substr($rootTpl, 0, 1) == '/' )
            $rootTpl = substr($rootTpl, 1);

        if ( strlen($rootTpl) > 0 && substr($rootTpl, -1) != '/' )
            $rootTpl .= '/';

        $this->tpl = new Template("$root/tpl");

        $templates = array(
            'head'   => 'Header.tpl',
            'random' => 'Random.tpl',
            'body'   => $rootTpl . $fileName,
            'cloud'  => 'BlogCloud.tpl',
            'foot'   => 'Footer.tpl'
        );
        
        $this->tpl->set_filenames($templates);

        if ( !( is_null($title) ) )
            $this->title($title);

        $this->user = new User();

        if ( $this->user->login )
        {
            $this->block('ifLogin')->end();

            if ( $this->user->admin )
                $this->block('ifAdmin')->end();
        }
        else
            $this->block('ifNLogin')->end();

        $this->random();
    }

    /**
     * @return Base
     */
    public function nav( $text, $link = null )
    {
        if ( is_null($link) )
            $this->end()
                 ->set( 'Nav' . camelCase($text, false) . 'Class', 'current' );
        else
        {
            /**
             * TODO: Agregar un nuevo NAV
             */
        }

        return $this;
    }

    /**
     * @return Base
     */
    public function title( $title )
    {
        if ( is_array($title) )
            $title = implode(' &raquo; ', $title);

        return $this->set( 'title', $title );
    }

    /**
     * @return Base
     */
    public function block( $name )
    {
        if ( is_string($name) )
        {
            $this->end();
            $this->block = $name;
        }
        else
        {
            if ( !( is_null($this->block) ) )
            {
                $this->tpl->assign_block_vars(
                    $this->block, $this->blockVars
                );
            }

            $this->block = null;
            $this->blockVars = array();
        }

        return $this;
    }

    /**
     * @return Base
     */
    public function validation( $rules = null )
    {
        if ( is_null($rules) && $this->validation )
        {
            if ( !( $this->validationFlag ) )
            {
                $this->validationFlag = true;

                // $this->block('validation');
                $this->tpl->assign_block_vars('validation', array());

                foreach ( $this->validation->errors as $error ){
                    $this->tpl->assign_block_vars(
                        'validation.' . $error['varName'] . '_' . $error['ruleName'], array()
                    );
                }
            }
        }
        else
        {
            $this->validationFlag = false;
            $this->validation = new Validation(
                $rules, array(), array_merge($_GET, $_POST)
            );
        }

        return $this;
    }

    public function isValid()
    {
        if ( $this->validation )
            return $this->validation->isValid();
        else
            return true;
    }

    /**
     * @return Base
     */
    public function end()
    {
        if ( !( $this->isValid() ) )
            $this->validation();

        if ( !( is_null($this->block) ) )
            $this->block(null);

        if ( sizeof($this->vars) > 0 )
            $this->tpl->assign_vars($this->vars);

        return $this;
    }

    /**
     * @return Base
     */
    public function set( $name, $value = null )
    {
        if ( is_null($value) && is_array($name) )
        {
            foreach ( $name as $name2 => $value2 )
                $this->set($name2, $value2);

            return $this;
        }

        if ( is_null($this->block) )
            $this->vars[$name] = $value;
        else
            $this->blockVars[$name] = $value;

        return $this;
    }

    public function get( $name )
    {
        if ( is_null($this->block) )
        {
            if ( isset($this->vars[$name]) )
                return $this->vars[$name];
        }
        elseif ( isset($this->blockVars[$name]) )
            return $this->blockVars[$name];

        return null;
    }

    public function __set( $name, $value ) { $this->set($name, $value); }
    public function __get( $name ) { return $this->get($name); }

    protected function random()
    {
        $result = Db::query(
            "SELECT libros.id_libros
                  , libros.isbn
                  , libros.titulo
                  , libros.anho
                  , libros.tomos
                  , libros.paginas
                  , libros.precio
                  , libros.fecha
                  , autores.id_autores
                  , autores.nombre AS autor
                  , editoriales.id_editoriales
                  , editoriales.nombre AS editorial
             FROM libros
             INNER JOIN autores
                     ON autores.id_autores = libros.id_autores
             INNER JOIN editoriales
                     ON editoriales.id_editoriales = libros.id_editoriales
             ORDER BY RAND()
             LIMIT 0,1"
        );

        $libro = $result[0];

        if ( $libro['tomos'] > 1 )
            $libro['s'] = 's';

        $libro['autorUri'] = '/buscar/+' . trim( urlencode($libro['autor']) ) . '/';
        $libro['editorialUri'] = '/buscar/+++' . trim( urlencode($libro['editorial']) ) . '/';
        $libro['url'] = trim( urlencode($libro['titulo']) );

        $this->tpl->assign_block_vars('random', $libro);

        if ( $libro['anho'] != 9999 && $libro['anho'] != 0 )
            $this->tpl->assign_block_vars('random.anho', array());

        if ( strlen($libro['isbn']) > 0 )
            $this->tpl->assign_block_vars('random.isbn', array());

        $this->tpl->assign_var_from_handle('random', 'random');
    }

    public function isModulo( $nombre )
    {
        static $modulos = null;

        if ( null === $modulos )
        {
            $modulos = array();
            $result = Db::query(
                "SELECT modulos.id_modulos
                      , modulos.nombre
                      , modulos.activo
                 FROM modulos"
            );

            foreach ( (array) $result as $row )
                $modulos[$row['nombre']] = ( $row['activo'] == 1 );
        }

        if ( isset($modulos[$nombre]) )
            return $modulos[$nombre];
        else
            return false;
    }

    protected function cloud()
    {
        $tags = Db::query(
            "SELECT noticias_etiquetas.etiqueta
                  , COUNT(noticias_etiquetas.etiqueta) AS total
               FROM noticias_etiquetas
          LEFT JOIN noticias_etiquetas noticias_etiquetas2
                 ON noticias_etiquetas2.etiqueta = noticias_etiquetas.etiqueta
                AND noticias_etiquetas2.id_noticias = noticias_etiquetas.id_noticias
           GROUP BY noticias_etiquetas.etiqueta"
        );

        $total = 0;

        foreach ( $tags as $tag )
            $total += $tag['total'];

        foreach ( $tags as $tag )
        {
            $lvl = round( ( ( $tag['total'] * 100 ) / $total ) / 10 );

            if ( $lvl > 5 )
                $lvl = 5;

            $this->tpl->assign_block_vars('cloud', array(
                'tag'   => $tag['etiqueta'],
                'total' => $tag['total'],
                'lvl'   => $lvl
            ));

            $this->tpl->assign_var_from_handle('cloud', 'cloud');
        }
    }

    public function __toString()
    {
        $this->end();

        $this->tpl->pparse('head');
        $this->tpl->pparse('body');
        $this->tpl->pparse('foot');
    }
}