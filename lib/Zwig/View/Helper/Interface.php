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
 * Zwig view helper interface
 *
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
interface Zwig_View_Helper_Interface extends Zend_View_Helper_Interface
{
    /**
     * If the returned array contains the current escaping context,
     * the output of the helper will not be escaped
     *
     * @return array
     */
    public function getSafe();
}

