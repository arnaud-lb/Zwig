<?php

class Zwig_NodeVisitor_Escaper extends Twig_NodeVisitor_Escaper
{
    // {{{ 
    /**
     * This is a list of builtin ZF view helpers.
     * 'html' means that the helper normaly outputs
     * HTML code and should not be escaped.
     *
     * For your own helpers, implement 
     * Zwig_View_Helper_Interface instead
     * or use the helper()|raw syntax.
     */
    protected $_builtin_helpers = array(
        'Zend_View_Helper_Abstract' => null,
        'Zend_View_Helper_Action' => null,
        'Zend_View_Helper_BaseUrl' => null,
        'Zend_View_Helper_Currency' => null,
        'Zend_View_Helper_Cycle' => null,
        'Zend_View_Helper_DeclareVars' => null,
        'Zend_View_Helper_Doctype' => 'html',
        'Zend_View_Helper_Fieldset' => 'html',
        'Zend_View_Helper_FormButton' => 'html',
        'Zend_View_Helper_FormCheckbox' => 'html',
        'Zend_View_Helper_FormElement' => 'html',
        'Zend_View_Helper_FormErrors' => 'html',
        'Zend_View_Helper_FormFile' => 'html',
        'Zend_View_Helper_FormHidden' => 'html',
        'Zend_View_Helper_FormImage' => 'html',
        'Zend_View_Helper_FormLabel' => 'html',
        'Zend_View_Helper_FormMultiCheckbox' => 'html',
        'Zend_View_Helper_FormNote' => 'html',
        'Zend_View_Helper_FormPassword' => 'html',
        'Zend_View_Helper_FormRadio' => 'html',
        'Zend_View_Helper_FormReset' => 'html',
        'Zend_View_Helper_FormSelect' => 'html',
        'Zend_View_Helper_FormSubmit' => 'html',
        'Zend_View_Helper_FormTextarea' => 'html',
        'Zend_View_Helper_FormText' => 'html',
        'Zend_View_Helper_Form' => 'html',
        'Zend_View_Helper_HeadLink' => 'html',
        'Zend_View_Helper_HeadMeta' => 'html',
        'Zend_View_Helper_HeadScript' => 'html',
        'Zend_View_Helper_HeadStyle' => 'html',
        'Zend_View_Helper_HeadTitle' => 'html',
        'Zend_View_Helper_HtmlElement' => 'html',
        'Zend_View_Helper_HtmlFlash' => 'html',
        'Zend_View_Helper_HtmlList' => 'html',
        'Zend_View_Helper_HtmlObject' => 'html',
        'Zend_View_Helper_HtmlPage' => 'html',
        'Zend_View_Helper_HtmlQuicktime' => 'html',
        'Zend_View_Helper_InlineScript' => 'html',
        'Zend_View_Helper_Interface' => null,
        'Zend_View_Helper_Json' => null,
        'Zend_View_Helper_Layout' => 'html',
        'Zend_View_Helper_Navigation_Breadcrumbs' => 'html',
        'Zend_View_Helper_Navigation_HelperAbstract' => 'html',
        'Zend_View_Helper_Navigation_Helper' => 'html',
        'Zend_View_Helper_Navigation_Links' => 'html',
        'Zend_View_Helper_Navigation_Menu' => 'html',
        'Zend_View_Helper_Navigation_Sitemap' => 'html',
        'Zend_View_Helper_Navigation' => 'html',
        'Zend_View_Helper_PaginationControl' => 'html',
        'Zend_View_Helper_Partial_Exception' => null,
        'Zend_View_Helper_PartialLoop' => 'html',
        'Zend_View_Helper_Partial' => 'html',
        'Zend_View_Helper_Placeholder_Container_Abstract' => 'html',
        'Zend_View_Helper_Placeholder_Container_Exception' => 'html',
        'Zend_View_Helper_Placeholder_Container_Standalone' => 'html',
        'Zend_View_Helper_Placeholder_Container' => 'html',
        'Zend_View_Helper_Placeholder_Registry_Exception' => 'html',
        'Zend_View_Helper_Placeholder_Registry' => 'html',
        'Zend_View_Helper_Placeholder' => 'html',
        'Zend_View_Helper_RenderToPlaceholder' => 'html',
        'Zend_View_Helper_ServerUrl' => null,
        'Zend_View_Helper_Translate' => null,
        'Zend_View_Helper_Url' => null,
    );
    // }}}

    protected function escapePrintNode(Twig_Node_Print $node, Twig_Environment $env, $type)
    {
        if (false === $type) {
            return $node;
        }

        $expression = $node->getNode('expr');

        if (!$expression instanceof Zwig_Node_Expression_ViewHelper) {
            return $node;
        }

        if ($this->isViewHelperEscaperFor($env, $expression->getHelper(), $type)) {
            $escaped = $this->getFilter('raw', $expression);
        } else {
            $escaped = $this->getEscaperFilter($type, $this->getFilter('string', $expression));
        }

        return new Twig_Node_Print($escaped, $node->getLine());
    }

    protected function getFilter($filter, Twig_NodeInterface $node, array $args = array()) {
        $line = $node->getLine();
        $name = new Twig_Node_Expression_Constant($filter, $line);
        $args = new Twig_Node($args);
        return new Twig_Node_Expression_Filter($node, $name, $args, $line);
    }

    protected function isViewHelperEscaperFor($env, $name, $type) {

        $helper = $env->view->getHelper($name);

        if (!$helper) {
            return false;
        }

        $safeness = null;

        do {
            if ($helper instanceof Zwig_View_Helper_Interface) {
                $safeness = $helper->getSafe();
                break;
            }

            $class = get_class($helper);

            do {
                if (isset($this->_builtin_helpers[$class])) {
                    $safeness = $this->_builtin_helpers[$class];
                    break 2;
                }
            } while (($class = get_parent_class($class)) !== false);

        } while (false);

        if (is_array($safeness)) {
            return in_array($type, $safeness) || in_array('all', $safeness);
        } else if (is_string($safeness)) {
            return $safeness == $type;
        }

        return false;
    }

    public function getPriority()
    {
        return -50;
    }
}

