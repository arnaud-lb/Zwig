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
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
class Zwig_TokenParserBroker extends Twig_TokenParserBroker
{
    protected $tokenParser;
    protected $env;

    public function __construct(Twig_TokenParserInterface $tokenParser, Zwig_Environment $env) {
        $this->tokenParser = $tokenParser;
        $this->env = $env;
    }

    /**
     * Returns $tokenParser if a Zend View Helper named $tag exists
     */
    public function getTokenParser($tag)
    {
        if ($this->env->getFunction($tag)) {
            return $this->tokenParser;
        }
    }

    public function setParser(Twig_ParserInterface $parser)
    {
        $this->tokenParser->setParser($parser);
        return parent::setParser($parser);
    }
}

