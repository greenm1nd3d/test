<?php
  function isProperlyNested($str) {
    $tags = [
        '(' => ')',
        '{' => '}',
        '[' => ']'
    ];
    $stack = [];
    $state = null;

    for ($i = 0, $length = strlen($str); $i < $length; $i++) {
        $char = $str[$i];

        if (isset($tags[$char])) {
            $stack[] = $state = $char;
        } else if ($state && $char == $tags[$state]) {
            array_pop($stack);
            $state = end($stack);
        } else {
            return 0;
        }
    }

    return count($stack) == 0;
  }

  $str = "{[]}";
  echo isProperlyNested($str);
?>