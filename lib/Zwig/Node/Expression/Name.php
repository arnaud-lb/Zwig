<?php

class Zwig_Node_Expression_Name extends Twig_Node_Expression_Name
{
    public function compile($compiler)
    {
        if ('_self' === $this['name']) {
            $compiler->raw('$this');
        } elseif ('_context' === $this['name']) {
            $compiler->raw('$context');
        } else {
            $compiler->raw(sprintf('$context[\'%s\']', $this['name']));
        }
    }

    public static function copyFrom(Twig_Node_Expression_Name $node) {
        return new Zwig_Node_Expression_Name($node['name'], $node->lineno);
    }
}
