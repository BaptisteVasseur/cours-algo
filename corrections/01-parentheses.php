<?php

require_once '01-pile.php';
require_once '01-file.php';

function isBalanced($str) {

    $openChars = ['(' => ')', '[' => ']', '{' => '}'];
    $closeChars = [')' => '(', ']' => '[', '}' => '{'];

    $stack = new Stack();

    $size = strlen($str);
    for ($i = 0; $i < $size; $i++) {
        $character = $str[$i];

        if (isset($openChars[$character])) {
            $stack->push($character);

        } elseif (isset($closeChars[$character])) {
            if ($stack->isEmpty()) {
                return false;
            }

            $lastOpen = $stack->pop();
            if ($closeChars[$character] !== $lastOpen) {
                return false;
            }
        }
    }

    return $stack->isEmpty();
}



var_dump(isBalanced("(()())")); // true
var_dump(isBalanced("(([{}])[)"));  // false
var_dump(isBalanced("ok"));      // true
var_dump(isBalanced("({[]*()})")); // true
var_dump(isBalanced("({[}])"));    // false
