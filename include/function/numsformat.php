<?php

//? for number format
function numsFormat(int|float $number, int $decimal_point = 10): string
{
    $nums = number_format(num: $number, decimals: $decimal_point, decimal_separator: ",", thousands_separator: ".");
    if ($decimal_point == 0) {
        return $nums;
    }
    $sub = substr(string: $nums, offset: -1);
    if ($sub == 0) {
        $nums = rtrim(string: $nums, characters: "0");
    }
    $sub = substr(string: $nums, offset: -1);
    if ($sub == ",") {
        $nums = substr(string: $nums, offset: 0, length: strlen($nums) - 1);
    }
    return $nums;
}
