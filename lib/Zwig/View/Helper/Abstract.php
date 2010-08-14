<?php

abstract class Zwig_View_helper_Abstract extends Zend_View_Helper_Abstract implements Zwig_View_Helper_Interface
{
    public function isEscaper()
    {
        return false;
    }
}

