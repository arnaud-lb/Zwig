<?php

class Zwig_FallbackArray implements ArrayAccess, IteratorAggregate {

    protected $_fallback_key = '-';
    protected $_handlers;

    public function __construct($handlers) {
        $this->_handlers = $handlers;
    }

    public function offsetExists($offset) {
        return array_key_exists($offset, $this->_handlers)
                || array_key_exists($this->_fallback_key, $this->_handlers);
    }

    public function offsetGet($offset) {
        if (array_key_exists($offset, $this->_handlers)) {
            return $this->_handlers[$offset];
        }
        if (array_key_exists($this->_fallback_key, $this->_handlers)) {
            return $this->_handlers[$this->_fallback_key];
        }
        return null;
    }

    public function offsetSet($offset, $value) {
        $this->_handlers[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->_handlers[$offset]);
    }

    public function getIterator() {
        return new ArrayIterator($this->_handlers);
    }
}

