<?php

class Zwig_Extension extends Twig_Extension
{
    protected $overrideEscape;

    public function __construct($override_escape = true)
    {
        $this->overrideEscape = $override_escape;
    }

    public function getTokenParsers()
    {
        return array(new Zwig_TokenParser_ViewHelper());
    }

    public function getFilters()
    {
        $filters = array(
            'js' => new Twig_Filter_Function('json_encode'),
            'string' => new Zwig_Filter_Cast('string'),
        );
        if ($this->overrideEscape) {
            $filters['escape'] = new Twig_Filter_Function('zwig_escape_filter', array('needs_environment' => true, 'is_escaper' => true));
            $filters['e'] = $filters['escape'];
        }
        return $filters;
    }

    public function getNodeVisitors()
    {
        $visitors = array(new Zwig_NodeVisitor_Escaper);
        return $visitors;
    }

    public function getName()
    {
        return 'Zwig';
    }
}

/*
 * This is twig_escape_filter without the is_string() check
 * so that zwig_escape_filter really escapes everything.
 */
function zwig_escape_filter(Twig_Environment $env, $string, $type = 'html')
{
    $string = (string) $string;

    switch ($type) {
        case 'js':
            // a function the c-escapes a string, making it suitable to be placed in a JavaScript string
            return str_replace(array("\\"  , "\n"  , "\r" , "\""  , "'"),
                                                 array("\\\\", "\\n" , "\\r", "\\\"", "\\'"),
                                                 $string);
        case 'html':
        default:
            return htmlspecialchars($string, ENT_QUOTES, $env->getCharset());
    }
}

