<?php namespace App;

/**
 * Class Main
 *
 * This class is a non-exhaustive list of PHP7 problems.
 *
 * @package App
 */
class Main
{
    /**
     * Old style constructors are ignored
     */
    public function Main()
    {
        $this->constructedProperly = true;
    }

    /**
     * We call this non-static method statically in helloWorld()
     * @return string
     * @codeCoverageIgnore
     */
    private function getPHPversion()
    {
        return $_SERVER['PHP_VERSION'];
    }

    /**
     * @return "hello world" in PHP4
     * @return null in PHP7
     */
    public function variableHandling()
    {
        $twoDimensionalArray = [
            "bar" => [
                "baz" => "foo",
            ]
        ];
        $foo = "hello world";
        $variableName = "twoDimensionalArray";
        return ${$twoDimensionalArray['bar']['baz']};
    }

    /**
     * This works in PHP5 but does not work in PHP7
     */
    public function variableMethods()
    {
        $foo = new Foo;
        $variableProperties = [
            'propertyA' => "dog",
            'propertyB' => "cat"
        ];
        $variableMethods = [
            'methodOne' => "sayHello",
            'methodTwo' => "sayGoodbye"
        ];
        $result = [
            $foo->$variableProperties['propertyB'],
            $foo->$variableMethods['methodOne'](),
            Foo::$variableMethods['methodTwo']()
        ];
        return $result;
    }

    /**
     * This works in PHP5 but PHP7 will not parse this script.
     */
    public function emptyListAssignment()
    {
        $a = '';
        list() = $a;
        list(,,) = $a;
        list($x, list(), $y) = $a;
        return $x;
    }

    public function foreachInternalPointer()
    {
        $output = [];
        $array = [0, 1, 2];
        foreach ($array as &$val) {
            $output[] = current($array);
        }
        return $output;
    }

    /**
     * In PHP5 returns [1,3];
     * In PHP7 returns [1, 2, 3];
     */
    public function foreachCopy()
    {
        $a = [1,2,3];
        $b = &$a;
        $c = [];
        foreach($a as $v) {
            $c[] = $v;
            unset($a[1]);
        }
        return $c;
    }

    /**
     * In PHP5 returns 1
     * In PHP7 returns 2
     */
    public function foreachReference()
    {
        $array = [0];
        $itemsCounted = 0;
        foreach ($array as &$val) {
            $itemsCounted++;
            $array[1] = 1;
        }
        return $itemsCounted;
    }

    /**
     * In PHP5 hexadecimal strings are considered numeric
     */
    public function isNumeric()
    {
        return is_numeric("0x123");
    }

    /**
     * All of these functions (and some more) are removed
     */
    public function removedFunctions()
    {
        $validData = ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", "2019-01-01", $regs);

        call_user_method('isNumeric', $this);

        set_magic_quotes_runtime(false);

        return true;
    }

    public function helloWorld()
    {
        $phpVersion = self::getPHPversion();
        echo "Welcome to PHP [$phpVersion]" . PHP_EOL;
        echo "-----------------------" . PHP_EOL;
        return true;
    }
}