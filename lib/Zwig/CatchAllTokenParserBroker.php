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
 * A token parser broker always returning the parser passed in constructor.
 *
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
class Zwig_CatchAllTokenParserBroker extends Twig_TokenParserBroker
{
    protected $tokenParser;

    public function __construct(Twig_TokenParserInterface $tokenParser) {
        $this->tokenParser = $tokenParser;
    }

    public function getTokenParser($tag)
    {
        return $this->tokenParser;
    }

    public function setParser(Twig_ParserInterface $parser)
    {
        $this->tokenParser->setParser($parser);
        return parent::setParser($parser);
    }
}

