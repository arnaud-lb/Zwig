<?php

class Zwig_Extension extends Twig_Extension
{
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
        return array(new Zwig_NodeVisitor_Escaper());
    }

    public function getName()
    {
        return 'Zwig';
    }
}
