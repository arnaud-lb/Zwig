<?php

class Zwig_Environment extends Twig_Environment
{
    public $view;

    public function __construct(Zwig_View $view, Twig_LoaderInterface $loader = null, $options = array(), Twig_LexerInterface $lexer = null, Twig_ParserInterface $parser = null, Twig_CompilerInterface $compiler = null) {

        $parser = $parser !== null ? $parser : new Zwig_Parser;

        $strictify = false;
        $override_escape = true;

        if (isset($options['strictify'])) {
            $strictify = $options['strictify'];
            unset($options['strictify']);
        }
        if (isset($options['override_escape'])) {
            $override_escape = $options['override_escape'];
            unset($options['override_escape']);
        }

        parent::__construct($loader, $options, $lexer, $parser, $compiler);

        $this->addExtension(new Zwig_Extension($strictify, $override_escape));
        $this->view = $view;
    }

    public function loadTemplate($template)
    {
        if ($template[0] !== '/') {
            $template = $this->view->script($template);
        }
        return parent::loadTemplate($template);
    }
}
