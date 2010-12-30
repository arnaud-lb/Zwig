<?php

class Zwig_Filter_Cast extends Twig_Filter
{
    protected $type;

    public function __construct($type, array $options = array())
    {
        parent::__construct($options);

        $this->type = $type;
    }

    public function compile()
    {
        return sprintf('(%s)', $this->type);
    }
}
