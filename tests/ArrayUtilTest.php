<?php

namespace TomHart\Utilities\Tests;

use PHPUnit\Framework\TestCase;
use TomHart\Utilities\ArrayUtil;

class ArrayUtilTest extends TestCase
{
    /**
     * Test a simple array with matching class works.
     */
    public function testSimpleArray(): void
    {
        $params = ['name', 'id'];
        $class = new \stdClass();
        $class->name = 'name';
        $class->id = 1;

        $data = ArrayUtil::populateArrayFromObject($params, $class);

        $this->assertSame(['name' => 'name', 'id' => 1], $data);
    }

    /**
     * Test missing data returns null.
     */
    public function testMissingData(): void
    {
        $params = ['name', 'id', 'extra'];
        $class = new \stdClass();
        $class->name = 'name';
        $class->id = 1;

        $data = ArrayUtil::populateArrayFromObject($params, $class);

        $this->assertSame(['name' => 'name', 'id' => 1, 'extra' => null], $data);
    }

    /**
     * Test nested classes.
     */
    public function testNestedClasses(): void
    {
        $params = ['name', 'id', 'extra->name'];
        $class = new \stdClass();
        $class->name = 'name';
        $class->id = 1;

        $class2 = new \stdClass();
        $class2->name = 'name-2';
        $class->extra = $class2;

        $data = ArrayUtil::populateArrayFromObject($params, $class);

        $this->assertSame(['name' => 'name', 'id' => 1, 'extra->name' => 'name-2'], $data);
    }

    /**
     * Test missing data can be supplied as a param
     */
    public function testMissingDataPulledFromParam(): void
    {
        $params = ['name', 'id', 'extra'];
        $class = new \stdClass();
        $class->name = 'name';
        $class->id = 1;

        $data = ArrayUtil::populateArrayFromObject($params, $class, ['extra' => 'param']);

        $this->assertSame(['name' => 'name', 'id' => 1, 'extra' => 'param'], $data);
    }
}
