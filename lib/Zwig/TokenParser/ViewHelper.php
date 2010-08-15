<?php

class Zwig_TokenParser_ViewHelper extends Twig_TokenParser
{
    /*
     * Parses {% someZendViewHelper (arg1, arg2, ...) %} with optional subscript expression
     */
    public function parse(Twig_Token $token)
    {
        $helper = $token->getValue();

        $args = $this->parser->getExpressionParser()->parseArguments();

        $node = new Zwig_Node_Expression_ViewHelper($helper, $args, $token->getLine(), $this->getTag());
        $node = $this->parser->getExpressionParser()->parseSubscriptExpression($node);

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new Zwig_Node_Stmt($node, array(), $token->getLine(), $this->getTag());
    }

    public function getTag() 
    {
        // The fallback tag
        return '-';
    }
}

