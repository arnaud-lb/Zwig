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

			$this->parser->getStream()->next();
			$test = $this->parser->getStream()->getCurrent();

			if ($test->test(Twig_Token::OPERATOR_TYPE, '(')) {
				$args = $this->parseArguments();
				$node = new Zwig_Node_Expression_ViewHelper($token->getValue(), $args, $token->getLine());
				if (!$assignment) {
					$node = $this->parsePostfixExpression($node);
				}
				return $node;
			}

			// reset stream->current
			$this->parser->getStream()->push($token);
			$this->parser->getStream()->push($token);
			$this->parser->getStream()->next();

			// rewind
			$this->parser->getStream()->push($token);
			$this->parser->getStream()->push($test);
		}
		return parent::parsePrimaryExpression($assignment);
	}
}

