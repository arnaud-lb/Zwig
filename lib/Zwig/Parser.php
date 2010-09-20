<?php

class Zwig_Parser extends Twig_Parser
{
    protected $expressionParser;

    public function __construct(Zwig_Environment $env = null)
    {
        parent::__construct($env);
        $this->expressionParser = new Zwig_ExpressionParser($this);
    }
}
