<?php

class Zwig_Environment extends Twig_Environment
{
    public $view;

    public function __construct(Zwig_View $view, Twig_LoaderInterface $loader = null, $options = array(), Twig_LexerInterface $lexer = null, Twig_ParserInterface $parser = null, Twig_CompilerInterface $compiler = null) {

        parent::__construct($loader, $options, $lexer, $parser, $compiler);

        $this->addExtension(new Zwig_Extension);
        $this->view = $view;
    }

    public function getParser()
    {
        if (null === $this->parser) {
            $this->parser = new Zwig_Parser($this);
        }
        return $this->parser;
    }

    public function loadTemplate($template)
    {
        if ($template[0] !== '/') {
            $template = $this->view->script($template);
        }
        return parent::loadTemplate($template);
    }
}
