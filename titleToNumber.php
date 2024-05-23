<?php

function titleToNumber($title)
{
    $dict = array_combine(range('A', 'Z'), range(1, 26));

    if (!preg_match('/^[A-Z]+$/', $title)) {
        throw new Exception("Title should contain only capital letters", 1);
    }

    $number = 0;
    for ($i = 0, $l = strlen($title); $i < $l; $i++) {
        $letter = $title[$l - $i - 1];
        $number += 26 ** $i * $dict[$letter];
    }
    return $number;
}

try {
    $titles = ['A', 'B', 'C', 'Z', 'AA', 'AB', 'AY', 'AZ', 'CB', 'YZ', 'ZZ', 'AAC'];
    $expected = [1, 2, 3, 26, 27, 28, 51, 52, 80, 676, 702, 705];

    foreach ($titles as $i => $title) {
        $res = titleToNumber($title);
        print_r(implode("\t", [
            $titles[$i],
            $res,
            (($res === $expected[$i]) ? "\033[32mY\033[0m" : "\033[31mN\033[0m")
        ]) . "\n");
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}
