<?php

class Zwig_View extends Zend_View_Abstract
{
    protected $_zwig;

    public function setEngine(Zwig_Environment $engine) {
        $this->_zwig = $engine;
    }

    public function getEngine() {
        return $this->_zwig;
    }

    public function _run() {

        $script = func_get_arg(0);
        $template = $this->_zwig->loadTemplate($script);
        $template->display(get_object_vars($this));
    }

    public function script($script) {
        return $this->_script($script);
    }
}

