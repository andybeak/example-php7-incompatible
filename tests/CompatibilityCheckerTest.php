<?php

use PHPUnit\Framework\TestCase;
use App\Main;

final class CompatibilityCheckerTest extends TestCase
{
    /**
     * @var Main
     */
    private $app;

    public function setUp(): void
    {
        parent::setUp();
        $this->app = new Main;
    }

    public function testConstructor()
    {
        $this->assertObjectHasAttribute('constructedProperly', new Main);
    }

    public function testVariableHandling()
    {
        $this->assertSame('hello world', $this->app->variableHandling());
    }

    public function testVariableMethods()
    {
        $php4Output = [
            0 => 'This is a cat',
            1 => 'Hello World from Foo',
            2 => 'Goodbye from Foo',
        ];
        $this->assertSame($php4Output, $this->app->variableMethods());
    }

    /**
     * PHP7 will not parse the script until you fix the syntax in Main::emptyListAssignment
     */
    public function testEmptyListAssignment()
    {
        $this->assertSame('', $this->app->emptyListAssignment());
    }

    public function testForeachInternalPointer()
    {
        $php4Output = [
            0 => 1,
            1 => 2,
            2 => false,
        ];
        $this->assertSame($php4Output, $this->app->variableMethods());
    }

    public function testForeachCopy()
    {
        $php4Output = [1,3];
        $this->assertSame($php4Output, $this->app->foreachCopy());
    }

    public function testForeachReference()
    {
        $php4Output = 1;
        $this->assertSame($php4Output, $this->app->foreachReference());
    }

    public function testIsNumeric()
    {
        $php4Output = true;
        $this->assertSame($php4Output, $this->app->isNumeric());
    }

    public function testRemovedFunctions()
    {
        $php4Output = true;
        $this->assertSame($php4Output, $this->app->removedFunctions());
    }

    public function testStaticMethod()
    {
        $php4Output = true;
        $this->assertSame($php4Output, $this->app->helloWorld());
    }
}