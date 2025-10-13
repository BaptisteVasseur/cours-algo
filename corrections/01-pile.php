<?php

class Stack {
    public function __construct(
        private array $elements = [],
    ) {
    }

    public function push($element)
    {
        $this->elements[] = $element;
    }

    public function pop()
    {
        $lastElement = $this->elements[$this->size() - 1];

        unset($this->elements[$this->size() - 1]);

        return $lastElement;
    }

    public function peek()
    {
        return $this->elements[$this->size() - 1];
    }

    public function isEmpty()
    {
        return $this->size() === 0;
    }

    public function size()
    {
        return count($this->elements);
    }

    public function clear()
    {
        $this->elements = [];
    }
}
