<?php

use App\StringCalculator;
use function PHPUnit\Framework\assertSame;

it('does not allow an empty input', function () {
    (new StringCalculator())->add('');
})->throws(Exception::class);

it('finds the sum of a single number', function (){
    assertSame(5, (new StringCalculator())->add('5'));
});

it('finds the sum of two numbers', function (){
    assertSame(10, (new StringCalculator())->add('5,5'));
});

it('finds the sum of any amount of numbers', function (){
    assertSame(19, (new StringCalculator())->add('5,5,5,4'));
});

it('accepts newline as delimiter', function (){
    assertSame(10, (new StringCalculator())->add("5\n5"));
});

it('does not allow negative numbers', function (){
    (new StringCalculator())->add("5\n-2");
})->throws(Exception::class);

it('allows mixing comma and newline delimiters', function() {
    assertSame(19, (new StringCalculator())->add("5,5\n5,4"));
});

it('ignores numbers bigger than 1000', function (){
    assertSame(5, (new StringCalculator())->add('2,3,1001'));
});

it('supports custom delimiters', function (){
    assertSame(20, (new StringCalculator())->add("//:\n5:4:11"));
});