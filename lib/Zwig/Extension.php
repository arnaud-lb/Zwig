<?php

/*
 * This file is part of Zwig.
 *
 * (c) 2010 Arnaud Le Blanc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Zwig Extension
 *
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
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

