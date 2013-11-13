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
 * Zwig Environment
 *
 * @package    zwig
 * @author     Arnaud Le Blanc <arnaud.lb@gmail.com>
 */
class Zwig_Environment extends Twig_Environment
{
    public $view;

    public function __construct(Zwig_View $view, Twig_LoaderInterface $loader = null, $options = array()) {

        parent::__construct($loader, $options);

        $this->addExtension(new Zwig_Extension($this));
        $this->view = $view;
    }

    public function getFunction($name)
    {
        if (false !== $function = parent::getFunction($name))
        {
            return $function;
        }

        try {
            $helper = $this->view->getHelper($name);
        } catch(Zend_Loader_PluginLoader_Exception $e) {
            return false;
        }

        if (null === $helper)
        {
            return false;
        }
        
        # Registering functions at runtime is no longer possible due to this patch:
        # https://github.com/fabpot/Twig/commit/44873875ff6ca50c654e3bd28fe19b7ce5108f42
        # To remedy we toggle $this->extensionInitialized off and back on again
        $this->extensionInitialized = false;
        
        $function = new Zwig_Function_ViewHelper($name, $helper);
        $this->addFunction($name, $function);
        
        $this->extensionInitialized = true;

        return $function;
    }
}
