<?php

class Zwig_Node_Expression_ViewHelper extends Twig_Node_Expression
{
    public function __construct($helper, $args, $lineno, $tag = null)
    {
        parent::__construct(array('args' => $args), array('helper' => $helper), $lineno, $tag);
    }

    public function getHelper()
    {
        return $this->getAttribute('helper');
    }

    public function compile($compiler)
    {
        $compiler->raw('$this->env->view->' . $this->getAttribute('helper') . '(');

        $first = true;
        foreach($this->getNode('args') as $arg) {
            if (!$first) $compiler->raw(', ');
            $first = false;
            $compiler->subcompile($arg);
        }

        $compiler->raw(")");
    }
}

