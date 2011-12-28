<?php

class Validation
{
    protected $rules = array();
    protected $messages = array();
    protected $vars = array();

    public $errors = array();

    public function __construct( $rules, $messages, $vars )
    {
        $this->rules = $rules;
        $this->messages = $messages;
        $this->vars = $vars;

        $this->valid();
    }

    protected function valid()
    {
        foreach ( $this->rules as $varName => $varRules )
        {
            if ( is_string($varRules) )
            {
                $rules = explode(' ', $varRules);
                $trues = array_fill(0, sizeof($rules), true);

                $varRules = array_combine($rules, $trues);
            }

            foreach ( $varRules as $ruleName => $param )
            {
                if ( !( $this->validRule($ruleName, $param, $this->vars[$varName]) ) )
                {
                    $error = '';

                    if ( !( isset($this->messages[$varName]) ) )
                        $error = "$varName is not valid";
                    if ( is_array($this->messages[$varName]) && isset($this->messages[$varName][$ruleName]) )
                        $error = $this->messages[$varName][$ruleName];
                    elseif ( is_string($this->messages[$varName]) )
                        $error = $this->messages[$varName];

                    $this->errors[] = array(
                        'varName'  => $varName,
                        'ruleName' => $ruleName,
                        'error'    => $error
                    );
                }
            }
        }
    }

    protected function validRule( $rule, $param, $var )
    {
        if ( method_exists($this, $rule) )
        {
            if ( $param === true )
                return $this->{$rule}( $var );
            else
                return $this->{$rule}( $var, $param );
        }

        return true;
    }

    public function isValid()
    {
        return ( sizeof($this->errors) == 0 );
    }

    public function __toString()
    {
        $li = array();

        foreach ( $this->errors as $error )
            $li[] = '<li><label for="' . $error['varName'] . '">' . $error['error'] . '</label></li>';

        if ( sizeof($li) > 0 )
            return '<ul class="validation">' . implode('', $li) . '</ul>';
        else
            return '';
    }

    protected function required( $var )
    {
        return !( empty($var) );
    }

    protected function minLength( $var, $minLength )
    {
        if ( $this->required($var) )
            return ( strlen($var) >= $minLength );
        else
            return true;
    }

    protected function maxLength( $var, $maxLength )
    {
        if ( $this->required($var) )
            return ( strlen($var) <= $maxLength );
        else
            return true;
    }

    protected function rangeLength( $var, $range )
    {
        if ( $this->required($var) )
            return ( strlen($var) >= $range[0] && strlen($var) <= $range[1] );
        else
            return true;
    }

    protected function minValue( $var, $minValue )
    {
        return ( $var >= $minValue );
    }

    protected function maxValue( $var, $maxValue )
    {
        return ( $var <= $maxValue );
    }

    protected function rangeValue( $var, $range )
    {
        return ( $var >= $range[0] && $var <= $range[1] );
    }

    protected function email( $var )
    {
        return preg_match('/^[^\s,;]+@([^\s.,;]+\.)+[\w-]{2,}$/', $var);
    }

    protected function url( $var )
    {
        if ( $this->required($var) )
            # return preg_match("/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/", $var);
            return preg_match("/(ftp|https?):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/", $var);
        else
            return true;
    }

    protected function date( $var )
    {
        return true;
    }

    protected function dateISO( $var )
    {
        return preg_match('/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/', $var);
    }

    protected function dateDE( $var )
    {
        return preg_match('/^\d\d?\.\d\d?\.\d\d\d?\d?$/', $var);
    }

    protected function number( $var )
    {
        return strlen($var) == 0 || preg_match('/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/', $var);
    }

    protected function numberDE( $var )
    {
        return preg_match('/^-?(?:\d+|\d{1,3}(?:\.\d{3})+)(?:,\d+)?$/', $var);
    }

    protected function digits( $var )
    {
        return preg_match('/^\d+$/', $var);
    }

    protected function equalTo( $var, $param )
    {
        return ( $var == $param );
    }
}