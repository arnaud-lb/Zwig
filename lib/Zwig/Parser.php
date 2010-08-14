<?php

class Zwig_Parser extends Twig_Parser
{
    protected $expressionParser;

    public function __construct(Zwig_Environment $env = null)
    {
        parent::__construct($env);
        $this->expressionParser = new Zwig_ExpressionParser($this);
    }
    
    public function subparse($test, $dropNeedle = false)
    {
        if (!is_object($this->handlers)) {
            $this->handlers = new Zwig_FallbackArray($this->handlers);
        }

        return parent::subparse($test, $dropNeedle);
    }
}
