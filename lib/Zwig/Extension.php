<?php

class Zwig_Extension extends Twig_Extension
{
    public function getTokenParsers()
    {
        $tokenParser = new Zwig_TokenParser_ViewHelper();
        $broker = new Zwig_CatchAllTokenParserBroker($tokenParser);
        return array($broker);
    }

    public function getFilters()
    {
        $filters = array(
            'js' => new Twig_Filter_Function('json_encode', array('is_safe' => array('js'))),
            'string' => new Zwig_Filter_Cast('string'),
        );
        return $filters;
    }

    public function getName()
    {
        return 'Zwig';
    }
}

