<?php

class Zwig_Node_Expression_GetAttr extends Twig_Node_Expression_GetAttr
{
    public function compile($compiler)
    {
        if ($this['type'] != Twig_Node_Expression_GetAttr::TYPE_ARRAY
                && !($this->attribute instanceof Twig_Node_Expression_Constant)) {
            return parent::compile($compiler);
        }

        $compiler->subcompile($this->node);

        if ($this['type'] == Twig_Node_Expression_GetAttr::TYPE_ARRAY) {
            $compiler->raw('[')->subcompile($this->attribute);
        } else {
            $compiler->raw('->')
                    ->raw($this->attribute['value']);
        }

        if ($this['type'] == Twig_Node_Expression_GetAttr::TYPE_ARRAY) {
            $compiler->raw(']');
        }

        if ($this['type'] == Twig_Node_Expression_GetAttr::TYPE_METHOD) {
            $compiler->raw('(');

            $first = true;
            foreach ($this->arguments as $node) {

                if (!$first) {
                    $compiler->raw(', ');
                }
                $first = false;
                $compiler->subcompile($node);
            }

            $compiler->raw(')');
        }
    }

    public static function copyFrom(Twig_Node_Expression_GetAttr $node) {
        Zend_Debug::dump($node->__toString());
        $node = new Zwig_Node_Expression_GetAttr($node->node, $node->attribute, $node->arguments, $node['type'], $node->lineno);
        Zend_Debug::dump($node->__toString());
        return $node;
    }
}

