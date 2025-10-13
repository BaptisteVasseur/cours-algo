<?php

class Queue {
    public function __construct(
        private array $elements = []
    )
    {}

    public function enqueue($element)
    {
        $this->elements[] = $element;
    }

    public function dequeue()
    {
        $count = count($this->elements);
        $dequeuedElement = null;

        for ($i = 0; $i < $count; $i++) {
            if ($i === 0) {
                $dequeuedElement = $this->elements[$i];
            } else {
                $this->elements[$i - 1] = $this->elements[$i];
            }
        }

        return $dequeuedElement;
    }

    public function front()
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->elements[0];
    }

    public function rear()
    {
        if ($this->isEmpty()) {
            return null;
        }

        $count = count($this->elements);
        return $this->elements[$count - 1];
    }

    public function isEmpty()
    {
        return $this->size() === 0;
    }

    public function size()
    {
        return count($this->elements);
    }

    public function contains($element)
    {
        foreach ($this->elements as $el) {
            if ($el === $element) {
                return true;
            }
        }

        return false;
    }
}

