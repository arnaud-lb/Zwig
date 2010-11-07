<?php

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

