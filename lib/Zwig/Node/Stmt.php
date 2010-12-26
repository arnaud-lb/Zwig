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
 * Zwig Node Statement
 *
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
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
            ->subcompile($this->getNode('expr'))
            ->raw(";\n")
        ;
    }
}
