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
 * ViewHelper TokenParser
 *
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
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
        $node = $this->parser->getExpressionParser()->parsePostfixExpression($node);

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new Zwig_Node_Stmt($node, array(), $token->getLine(), $this->getTag());
    }

    public function getTag() 
    {
        return 'Zend_View_Helper';
    }
}

