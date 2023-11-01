<?php

function generateRandomString($length = 8): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($characters), 0, $length);
}

function calculateDiscountedPrice($price, $discount_percent): float|int
{
    return $price * (100 - $discount_percent) / 100;
}
?>
