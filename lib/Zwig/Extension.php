<?php

class Zwig_Extension extends Twig_Extension
{
    protected $strictify = false;

    public function __construct($strictify = false)
    {
        $this->strictify = $strictify;
    }

    public function getTokenParsers()
    {
        return array(new Zwig_TokenParser_ViewHelper());
    }

    public function getFilters()
    {
        return array(
            'js' => new Twig_Filter_Function('json_encode'),
            'string' => new Zwig_Filter_Cast('string'),
        );
    }

    public function getNodeVisitors()
    {
        $visitors = array(new Zwig_NodeVisitor_Escaper);
        if ($this->strictify) {
            $visitors[] = new Zwig_NodeVisitor_Strictify;
        }
        return $visitors;
    }

    public function getName()
    {
        return 'Zwig';
    }
}
