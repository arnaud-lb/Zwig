<?php

class Zwig_NodeVisitor_Escaper extends Twig_NodeVisitor_Escaper
{
    // {{{ 
    /**
     * This is a list of builtin ZF view helpers.
     * True means that the helper normaly outputs
     * HTML code and should not be escaped.
     *
     * For your own helpers, implement 
     * Zwig_View_Helper_Interface instead
     * or use the helper()|raw syntax.
     */
    protected $_builtin_helpers = array(
        'Zend_View_Helper_Abstract' => false,
        'Zend_View_Helper_Action' => false,
        'Zend_View_Helper_BaseUrl' => false,
        'Zend_View_Helper_Currency' => false,
        'Zend_View_Helper_Cycle' => false,
        'Zend_View_Helper_DeclareVars' => false,
        'Zend_View_Helper_Doctype' => true,
        'Zend_View_Helper_Fieldset' => true,
        'Zend_View_Helper_FormButton' => true,
        'Zend_View_Helper_FormCheckbox' => true,
        'Zend_View_Helper_FormElement' => true,
        'Zend_View_Helper_FormErrors' => true,
        'Zend_View_Helper_FormFile' => true,
        'Zend_View_Helper_FormHidden' => true,
        'Zend_View_Helper_FormImage' => true,
        'Zend_View_Helper_FormLabel' => true,
        'Zend_View_Helper_FormMultiCheckbox' => true,
        'Zend_View_Helper_FormNote' => true,
        'Zend_View_Helper_FormPassword' => true,
        'Zend_View_Helper_FormRadio' => true,
        'Zend_View_Helper_FormReset' => true,
        'Zend_View_Helper_FormSelect' => true,
        'Zend_View_Helper_FormSubmit' => true,
        'Zend_View_Helper_FormTextarea' => true,
        'Zend_View_Helper_FormText' => true,
        'Zend_View_Helper_Form' => true,
        'Zend_View_Helper_HeadLink' => true,
        'Zend_View_Helper_HeadMeta' => true,
        'Zend_View_Helper_HeadScript' => true,
        'Zend_View_Helper_HeadStyle' => true,
        'Zend_View_Helper_HeadTitle' => true,
        'Zend_View_Helper_HtmlElement' => true,
        'Zend_View_Helper_HtmlFlash' => true,
        'Zend_View_Helper_HtmlList' => true,
        'Zend_View_Helper_HtmlObject' => true,
        'Zend_View_Helper_HtmlPage' => true,
        'Zend_View_Helper_HtmlQuicktime' => true,
        'Zend_View_Helper_InlineScript' => true,
        'Zend_View_Helper_Interface' => false,
        'Zend_View_Helper_Json' => false,
        'Zend_View_Helper_Layout' => true,
        'Zend_View_Helper_Navigation_Breadcrumbs' => true,
        'Zend_View_Helper_Navigation_HelperAbstract' => true,
        'Zend_View_Helper_Navigation_Helper' => true,
        'Zend_View_Helper_Navigation_Links' => true,
        'Zend_View_Helper_Navigation_Menu' => true,
        'Zend_View_Helper_Navigation_Sitemap' => true,
        'Zend_View_Helper_Navigation' => true,
        'Zend_View_Helper_PaginationControl' => true,
        'Zend_View_Helper_Partial_Exception' => false,
        'Zend_View_Helper_PartialLoop' => true,
        'Zend_View_Helper_Partial' => true,
        'Zend_View_Helper_Placeholder_Container_Abstract' => true,
        'Zend_View_Helper_Placeholder_Container_Exception' => true,
        'Zend_View_Helper_Placeholder_Container_Standalone' => true,
        'Zend_View_Helper_Placeholder_Container' => true,
        'Zend_View_Helper_Placeholder_Registry_Exception' => true,
        'Zend_View_Helper_Placeholder_Registry' => true,
        'Zend_View_Helper_Placeholder' => true,
        'Zend_View_Helper_RenderToPlaceholder' => true,
        'Zend_View_Helper_ServerUrl' => false,
        'Zend_View_Helper_Translate' => false,
        'Zend_View_Helper_Url' => false,
    );
    // }}}

    protected function escapeNode(Twig_NodeInterface $node, Twig_Environment $env, $type)
    {
        if (false === $type) {
            return $node;
        }

        $expression = $node instanceof Twig_Node_Print ? $node->getNode('expr') : $node;

        if (!$expression instanceof Zwig_Node_Expression_ViewHelper) {
            return $node;
        }

        if ($this->isViewHelperEscaper($env, $expression->getHelper())) {
            $escaped = $node instanceof Twig_Node_Print ? $expression : $node;
            $escaped = $this->getFilterNode($escaped, $this->getFilter('raw', $escaped->getLine()));
        } else {
            $escaped = $node instanceof Twig_Node_Print ? $expression : $node;
            $escaped = $this->getFilterNode($escaped, $this->getFilter('string', $escaped->getLine()));
            $escaped = $this->getFilterNode($escaped, $this->getEscaperFilter($type, $escaped->getLine()));
        }

        if ($node instanceof Twig_Node_Print) {
            return new Twig_Node_Print($escaped, $node->getLine());
        } else {
            return $escaped;
        }
    }

    protected function getFilterNode($node, $filter) {
        return new Twig_Node_Expression_Filter($node, new Twig_Node($filter), $node->getLine());
    }

    protected function getFilter($name, $line) {
        return array(new Twig_Node_Expression_Constant($name, $line), new Twig_Node(array()));
    }

    protected function isViewHelperEscaper($env, $name) {

        $helper = $env->view->getHelper($name);

        if (!$helper) {
            return false;
        }

        if ($helper instanceof Zwig_View_Helper_Interface) {
            return $helper->isEscaper();
        }

        $class = get_class($helper);

        do {
            if (isset($this->_builtin_helpers[$class])) {
                return $this->_builtin_helpers[$class];
            }
        } while (($class = get_parent_class($class)) !== false);

        return false;
    }
}

