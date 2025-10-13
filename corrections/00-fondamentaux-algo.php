<?php

function myPush(&$arr, $element) {
  $arr[] = $element;
  return count($arr);
}

function myPop(&$arr) {
  if (count($arr) === 0) {
    return null;
  }

  $lastElement = $arr[count($arr) - 1];
  $newArr = [];
  for ($i = 0; $i < count($arr) - 1; $i++) {
    $newArr[] = $arr[$i];
  }
  $arr = $newArr;
  return $lastElement;
}

function myIndexOf($arr, $element) {
  for ($i = 0; $i < count($arr); $i++) {
    if ($arr[$i] === $element) {
      return $i;
    }
  }

  return -1;
}

function myIncludes($arr, $element) {
  return myIndexOf($arr, $element) !== -1;
}

function myReverse(&$arr) {
  $start = 0;
  $end = count($arr) - 1;

  while ($start < $end) {
    $temp = $arr[$start];
    $arr[$start] = $arr[$end];
    $arr[$end] = $temp;
    $start++;
    $end--;
  }

  return $arr;
}

function myJoin($arr, $separator = ',') {
  if (count($arr) === 0) {
    return '';
  }

  $result = '';
  for ($i = 0; $i < count($arr) - 1; $i++) {
    $result .= $arr[$i] . $separator;
  }
  
  $result .= $arr[count($arr) - 1];
  return $result;
}

function myFilter($arr, $callback) {
  $result = [];
  for ($i = 0; $i < count($arr); $i++) {
    if ($callback($arr[$i], $i, $arr)) {
      $result[] = $arr[$i];
    }
  }

  return $result;
}

function myMap($arr, $callback) {
  $result = [];
  for ($i = 0; $i < count($arr); $i++) {
    $result[] = $callback($arr[$i], $i, $arr);
  }

  return $result;
}

function myFind($arr, $callback) {
  for ($i = 0; $i < count($arr); $i++) {
    if ($callback($arr[$i], $i, $arr)) {
      return $arr[$i];
    }
  }
  
  return null;
}

function myEvery($arr, $callback) {
  for ($i = 0; $i < count($arr); $i++) {
    if (!$callback($arr[$i], $i, $arr)) {
      return false;
    }
  }

  return true;
}

function mySome($arr, $callback) {
  for ($i = 0; $i < count($arr); $i++) {
    if ($callback($arr[$i], $i, $arr)) {
      return true;
    }
  }

  return false;
}

function myConcat($arr, ...$arrays) {
  $result = [];

  for ($i = 0; $i < count($arr); $i++) {
    $result[] = $arr[$i];
  }

  for ($i = 0; $i < count($arrays); $i++) {
    if (is_array($arrays[$i])) {
      for ($j = 0; $j < count($arrays[$i]); $j++) {
        $result[] = $arrays[$i][$j];
      }
    } else {
      $result[] = $arrays[$i];
    }
  }

  return $result;
}

function myCharAt($str, $index) {
  if ($index < 0 || $index >= strlen($str)) {
    return '';
  }

  return substr($str, $index, 1);
}

function mySubstring($str, $start, $end = null) {
  if ($end === null) {
    $end = strlen($str);
  }
  if ($start > $end) {
    $temp = $start;
    $start = $end;
    $end = $temp;
  }

  if ($start < 0) {
    $start = 0;
  }

  if ($end > strlen($str)) {
    $end = strlen($str);
  }

  $result = '';
  for ($i = $start; $i < $end; $i++) {
    $result .= substr($str, $i, 1);
  }

  return $result;
}

function mySplit($str, $separator) {
  if ($separator === '') {
    $result = [];
    for ($i = 0; $i < strlen($str); $i++) {
      $result[] = substr($str, $i, 1);
    }

    return $result;
  }
  
  $result = [];
  $current = '';
  
  for ($i = 0; $i < strlen($str); $i++) {
    $match = true;
    for ($j = 0; $j < strlen($separator); $j++) {
      if (substr($str, $i + $j, 1) !== substr($separator, $j, 1)) {
        $match = false;
        break;
      }
    }
    
    if ($match) {
      $result[] = $current;
      $current = '';
      $i += strlen($separator) - 1;
    } else {
      $current .= substr($str, $i, 1);
    }
  }
  
  $result[] = $current;
  return $result;
}

function myRepeat($str, $count) {
  if ($count <= 0) {
    return '';
  }
  
  $result = '';
  for ($i = 0; $i < $count; $i++) {
    $result .= $str;
  }

  return $result;
}

function myTrim($str) {
  $start = 0;
  $end = strlen($str) - 1;
  
  while ($start < strlen($str) && substr($str, $start, 1) === ' ') {
    $start++;
  }
  
  while ($end >= 0 && substr($str, $end, 1) === ' ') {
    $end--;
  }
  
  if ($start > $end) {
    return '';
  }
  
  $result = '';
  for ($i = $start; $i <= $end; $i++) {
    $result .= substr($str, $i, 1);
  }
  
  return $result;
}

