<?php

class Zwig_Node_Expression_ViewHelper extends Twig_Node_Expression
{
    protected $_helper;

    public function __construct($helper, $args, $lineno, $tag = null)
    {
        parent::__construct(array('args' => $args), array(), $lineno, $tag);
        $this->_helper = $helper;
    }

    public function getHelper()
    {
        return $this->_helper;
    }

    public function compile($compiler)
    {
        $compiler->raw('$this->env->view->' . $this->_helper . '(');

        $first = true;
        foreach($this->args as $arg) {
            if (!$first) $compiler->raw(', ');
            $first = false;
            $compiler->subcompile($arg);
        }

        $compiler->raw(")");
    }
}

