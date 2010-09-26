<?php

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

