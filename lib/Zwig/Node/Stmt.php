<?php

class Zwig_Node_Stmt extends Twig_Node
{

    public function __construct($expr, array $attrs, $lineno, $tag = null)
    {
        parent::__construct(array('expr' => $expr), $attrs, $lineno, $tag);
    }

    public function compile($compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->addIndentation()
            ->subcompile($this->expr)
            ->raw(";\n")
        ;
    }
}
