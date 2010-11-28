<?php

class Zwig_Parser extends Twig_Parser
{
    public function parse(Twig_TokenStream $stream)
    {
        if (null === $this->expressionParser) {
            $this->expressionParser = new Zwig_ExpressionParser($this, $this->env->getUnaryOperators(), $this->env->getBinaryOperators());
        }

        return parent::parse($stream);
    }
}
