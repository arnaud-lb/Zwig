<?php

class Zwig_Loader_Filesystem extends Twig_Loader_Filesystem
{
    protected $alwaysReload;

    function __construct($paths, $alwaysReload = false)
    {
        $this->alwaysReload = $alwaysReload;
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

