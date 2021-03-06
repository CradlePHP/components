<?php

namespace Cradle\Data;

use Countable;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:10:59.
 */
class Cradle_Data_CountableTrait_Test extends TestCase
{
    /**
     * @var CountableTrait
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new CountableTraitStub;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Cradle\Data\CountableTrait::count
     */
    public function testCount()
    {
		$this->assertEquals(4, count($this->object));
    }
}

if(!class_exists('Cradle\Data\CountableTraitStub')) {
	class CountableTraitStub implements Countable
	{
		use CountableTrait;
		
		protected $data = array(4, 5, 6, 7);
	}
}
