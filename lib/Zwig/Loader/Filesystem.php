<?php

class Zwig_Loader_Filesystem extends Twig_Loader_Filesystem
{
    protected $alwaysResload;

    function __construct($paths, $always_reload = false)
    {
        $this->alwaysReload = $always_reload;
        parent::__construct($paths);
    }

    function isFresh($name, $time)
    {
        if ($this->alwaysReload) {
            return false;
        }
        return parent::isFresh($name, $time);
    }
}

