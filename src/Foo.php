<?php namespace App;

class Foo
{
    public $dog = "This is a dog";
    public $cat = "This is a cat";

    public function sayHello()
    {
        return "Hello World from Foo";
    }

    public static function sayGoodbye()
    {
        return "Goodbye from Foo";
    }
}