<?php

class Zwig_NodeVisitor_Strictify implements Twig_NodeVisitorInterface
{
    public function enterNode(Twig_NodeInterface $node, Twig_Environment $env)
    {
        if ($node instanceof Twig_Node_Expression_GetAttr) {
            return Zwig_Node_Expression_GetAttr::copyFrom($node);
        } else if ($node instanceof Twig_Node_Expression_Name) {
            return Zwig_Node_Expression_Name::copyFrom($node);
        }
        return $node;
    }

    public function leaveNode(Twig_NodeInterface $node, Twig_Environment $env)
    {
        return $node;
    }
}

