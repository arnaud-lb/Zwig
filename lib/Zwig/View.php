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
 * Zwig View
 *
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
class Zwig_View extends Zend_View_Abstract
{
    protected $_pathSet = false;

    protected $_zwig;

    public function setEngine(Twig_Environment $engine) {
        $this->_zwig = $engine;
    }

    public function getEngine() {
        return $this->_zwig;
    }

    public function addScriptPath($path) {
        $this->_pathSet = false;
        return parent::addScriptPath($path);
    }

    public function setScriptPath($path) {
        $this->_pathSet = false;
        return parent::setScriptPath($path);
    }

    protected function _script($name) {
        return $name;
    }

    public function _run() {
        $script = func_get_arg(0);
        if (!$this->_pathSet && method_exists($this->_zwig->getLoader(), 'setPaths')) {
            $this->_zwig->getLoader()->setPaths($this->getScriptPaths());
            $this->_pathSet = true;
        }
        $template = $this->_zwig->loadTemplate($script);
        $template->display(get_object_vars($this));
    }
}

