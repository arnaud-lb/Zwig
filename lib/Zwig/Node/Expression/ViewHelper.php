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
 * ViewHelper Node
 *
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
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
        $compiler->raw('$this->env->view->getHelper(');
        $compiler->repr($this->getAttribute('helper'));
        $compiler->raw(')->' . $this->getAttribute('helper') . '(');

        $first = true;
        foreach($this->getNode('args') as $arg) {
            if (!$first) $compiler->raw(', ');
            $first = false;
            $compiler->subcompile($arg);
        }

        $compiler->raw(")");
    }
}

