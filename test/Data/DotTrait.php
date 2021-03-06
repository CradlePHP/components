<?php

namespace Cradle\Data;

use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:10:59.
 */
class Cradle_Data_DotTrait_Test extends TestCase
{
    /**
     * @var DotTrait
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new DotTraitStub;

        $this->object->setDot('foo', 'bar');
        $this->object->setDot('bar', 'foo');
        $this->object->setDot('bar.zoo', 'zoo');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Cradle\Data\DotTrait::getDot
     */
    public function testGetDot()
    {
        $this->assertEquals('bar', $this->object->getDot('foo'));
        $this->assertEquals('zoo', $this->object->getDot('bar.zoo'));

        $this->assertNull($this->object->getDot(''));
        $this->assertNull($this->object->getDot('foo.foo.bar'));
    }

    /**
     * @covers Cradle\Data\DotTrait::isDot
     */
    public function testIsDot()
    {
        $this->assertTrue($this->object->isDot('bar'));
        $this->assertTrue($this->object->isDot('bar.zoo'));
        $this->assertFalse($this->object->isDot(''));
    }

    /**
     * @covers Cradle\Data\DotTrait::removeDot
     */
    public function testRemoveDot()
    {
        $instance = $this->object->removeDot('');
        $this->assertInstanceOf('Cradle\Data\DotTraitStub', $instance);

        $this->object->removeDot('foo');
        $this->assertFalse($this->object->isDot('foo'));

        $this->object->removeDot('bar.zoo');
        $this->assertFalse($this->object->isDot('bar.zoo'));
    }

    /**
     * @covers Cradle\Data\DotTrait::setDot
     */
    public function testSetDot()
    {
        $instance = $this->object->setDot('', 'foo');
        $this->assertInstanceOf('Cradle\Data\DotTraitStub', $instance);
        $this->object->setDot('zoo', 2);
        $this->assertEquals(2, $this->object->getDot('zoo'));
    }
}

if(!class_exists('Cradle\Data\DotTraitStub')) {
    class DotTraitStub
    {
        use DotTrait;

        protected $data = array();
    }
}
