<?php

interface Zwig_View_Helper_Interface extends Zend_View_Helper_Interface
{
    /**
     * If isEscaper() returns true, output of this helper
     * will not be escaped by default.
     */
    public function isEscaper();
}

