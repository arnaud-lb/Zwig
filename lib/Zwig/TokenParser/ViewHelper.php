<?php

class Zwig_TokenParser_ViewHelper extends Twig_TokenParser
{
	/*
	 * Parses {% someZendViewHelper (arg1, arg2, ...) %}
	 */
	public function parse(Twig_Token $token)
	{
		$helper = $token->getValue();

		$args = $this->parser->getExpressionParser()->parseArguments();

		$this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

		$expr = new Zwig_Node_Expression_ViewHelper($helper, $args, $token->getLine(), $this->getTag());
		return new Zwig_Node_Stmt($expr, array(), $token->getLine(), $this->getTag());
	}

	public function getTag() 
	{
		// The fallback tag
		return '-';
	}
}

