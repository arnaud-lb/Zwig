<?php

class Zwig_Environment extends Twig_Environment
{
    public $view;

    public function __construct(Zwig_View $view, Twig_LoaderInterface $loader = null, $options = array()) {

        parent::__construct($loader, $options);

        $this->addExtension(new Zwig_Extension);
        $this->view = $view;
    }

    public function getFunction($name)
    {
        if (null !== $function = parent::getFunction($name))
        {
            return $function;
        }

        $helper = $this->view->getHelper($name);

        if (null === $helper)
        {
            return null;
        }

        $function = new Zwig_Function_ViewHelper($name, $helper);
        $this->addFunction($name, $function);

        return $function;
    }
}
