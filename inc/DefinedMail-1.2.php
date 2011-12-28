<?php

class DefinedMail
{
    protected static $from = null;
    protected static $fromName = null;

    public static function from( $mail, $name = null )
    {
        self::$from = $mail;
        self::$fromName = $name;
    }

    protected static function __from()
    {
        if ( is_null(self::$fromName) )
            return self::$from;
        else
        {
            if ( strpos(self::$fromName, ' ') !== false )
                $name = '"' . self::$fromName . '"';
            else
                $name = self::$fromName;

            return $name . ' <' . self::$from . '>';
        }
    }

    /**
     * Creates a new mail.
     *
     * @param string $subject
     * @return DefinedMail
     */
    public static function mail( $subject = '(no subject)' )
    {
        return new DefinedMail($subject);
    }

    protected $boundary = null;
    protected $headers = array();
    protected $subject = null;
    protected $to = array();
    protected $text = '';
    protected $body = array();
    protected $attach = false;

    public function __construct( $subject )
    {
        $this->subject = $subject;
        $this->boundary = '<<<--==+X[' . md5( time() ) . ']';
    }

    /**
     * Append a mail header.
     *
     * @param string $name
     * @param string $value
     * @return DefinedMail
     */
    public function header( $name, $value )
    {
        if ( !( isset($this->headers[$name]) ) )
            $this->headers[$name] = $value;

        return $this;
    }

    protected function __header()
    {
        $return = array();

        foreach ( $this->headers as $name => $value )
            $return[] = "$name: $value";

        return implode("\n", $return);
    }

    /**
     * Append a to mail.
     *
     * @param string $mail
     * @param string $name
     * @return DefinedMail
     */
    public function to( $mail, $name = null )
    {
        if ( is_array($mail) )
        {
            foreach ( $mail as $key => $value )
            {
                if ( is_string($key) || is_array($key) )
                    $this->to($key, $value);
                elseif ( is_array($value) )
                    $this->to($value);
            }
        }
        elseif ( is_string($mail) && !( isset($this->to[$mail]) ) )
            $this->to[$mail] = $name;

        return $this;
    }

    protected function __to()
    {
        $return = array();

        foreach ( $this->to as $mail => $name )
        {
            if ( is_null($name) )
                $return[] = $mail;
            else
            {
                if ( strpos($name, ' ') !== false )
                    $name = '"' . $name . '"';

                $return[] = "$name <$mail>";
            }
        }

        return implode(', ', $return);
    }

    /**
     * Appends HTML content to the body.
     *
     * @param string $html
     * @return DefinedMail
     */
    public function html( $html )
    {
        $this->body[] = array(
            'type' => 'html',
            'data' => $html
        );

        return $this;
    }

    /**
     * Appends Text content to the body.
     *
     * @param string $text
     * @return DefinedMail
     */
    public function text( $text )
    {
        if ( strlen($text) > 0 )
            $this->text = $text;

        return $this;
    }

    /**
     * Appends an attach to the mail.
     *
     * @param string $file
     * @return DefinedMail
     */
    public function attach( $file )
    {
        static $types = array(
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',

            'html' => 'text/html',
            'txt'  => 'text/plain'
        );

        $extension = array_pop( explode('.', $file) );

        $this->attach = true;
        $this->body[] = array(
            'type' => 'attach',

            'dataName' => $file,
            'dataType' => $types[$extension],
            'data'     => file_get_contents($file)
        );

        return $this;
    }

    protected function __body()
    {
        $return = '';
        $completeText = ( strlen($this->text) == 0 ) ? true : false;

        foreach ( $this->body as $body )
        {
            $piece = '';
            $data = base64_encode($body['data']);

            switch ( $body['type'] )
            {
                case 'html':
                    if ( $completeText )
                        $this->text .= strip_tags( $body['data'] );

                    $piece .= <<<PIECE

--$this->boundary
Content-type: text/html; charset=UTF-8
Content-Transfer-Encoding: base64
Content-Disposition: inline

$data
PIECE;
                    break;

                case 'attach':
                    $piece .= <<<PIECE

--$this->boundary
Content-type: {$body['dataType']}; name={$body['dataName']}
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename={$body['dataName']}

$data
PIECE;
                    break;
            }

            $return .= $piece;
        }

        if ( strlen($this->text) > 0 )
        {
            $text = <<<PIECE
--$this->boundary
Content-type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 7bit
Content-Disposition: inline

$this->text
PIECE;

            $return = $text . $return;
        }

        return "$return\n--$this->boundary--";
    }

    /**
     * Send the mail.
     *
     * @return boolean
     */
    public function send()
    {
        if ( sizeof($this->to) == 0 )
            return false;

        $this->header('MIME-Version', '1.0')
             ->header('Content-Type', 'multipart/' . ( ( $this->attach ) ? 'mixed' : 'alternative' ) . '; boundary="' . $this->boundary . '"')
             ->header('From', self::__from())
             ->header('X-Mailer', 'PHP/' . phpversion());

        $emailTo = $this->__to();
        $emailSubject = $this->subject;
        $emailBody = $this->__body();
        $emailHeaders = $this->__header();

        return ( @mail($emailTo, $emailSubject, $emailBody, $emailHeaders) );
    }
}