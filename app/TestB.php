<?php
/**
 * Created by PhpStorm.
 * User: lowkey
 * Date: 17-6-14
 * Time: 下午4:40
 */
namespace App;

class TestB{
    private $a;
    function __construct(TestA $a)
    {
        $this->a = $a;
    }
}