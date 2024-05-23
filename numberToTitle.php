<?php

function numberToTitle($number)
{
    $dict = implode('', range('A', 'Z'));

    if (!is_int($number)) {
        throw new Exception("Integer value expected!", 1);
    }

    $title = '';
    while ($number > 0) {
        $remainder = $number % 26;
        $quotient = intdiv($number, 26);

        $title = $dict[$remainder - 1] . $title;

        $number = ($remainder === 0) ? $quotient - 1 : $quotient;
    }
    return $title;
}

try {
    $numbers =  [1,  2,  3,  26,  27,  28,  51,  52,  80,  676,  702,  705];
    $expected = ['A', 'B', 'C', 'Z', 'AA', 'AB', 'AY', 'AZ', 'CB', 'YZ', 'ZZ', 'AAC'];
    
    foreach ($numbers as $i => $number) {
        $res = numberToTitle($number);
        print_r(implode("\t", [
            $numbers[$i], 
            $res, 
            (($res === $expected[$i]) ? "\033[32mY\033[0m" : "\033[31mN\033[0m")
        ]) . "\n");
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}
