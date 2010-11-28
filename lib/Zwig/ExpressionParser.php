<?php

class Zwig_ExpressionParser extends Twig_ExpressionParser
{
    /* parses {{ helper(arg1, ..) }} */
    public function parsePrimaryExpression($assignment = false)
    {
        $token = $this->parser->getCurrentToken();
        $value = $token->getValue();

        if ($token->getType() == Twig_Token::NAME_TYPE
                && $value !== 'true' && $value !== 'false' && $value !== 'none') {

            $this->parser->getStream()->rewind();
            if ($this->parser->getStream()->look()->test(Twig_Token::PUNCTUATION_TYPE, '(')) {
                $this->parser->getStream()->next();
                $args = $this->parseArguments();
                $node = new Zwig_Node_Expression_ViewHelper($token->getValue(), $args, $token->getLine());
                if (!$assignment) {
                    $node = $this->parsePostfixExpression($node);
                }
                return $node;
            }
            $this->parser->getStream()->rewind();
        }
        return parent::parsePrimaryExpression($assignment);
    }
}

