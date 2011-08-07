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
    protected $env;

    public function __construct(Zwig_Environment $env)
    {
        $this->env = $env;
    }

    public function getTokenParsers()
    {
        $tokenParser = new Zwig_TokenParser_ViewHelper();
        $broker = new Zwig_TokenParserBroker($tokenParser, $this->env);
        return array($broker);
    }

    public function getName()
    {
        return 'Zwig';
    }
}

