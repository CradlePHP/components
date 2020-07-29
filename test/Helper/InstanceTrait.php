<?php

namespace Cradle\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:11:00.
 */
class Cradle_Helper_InstanceTrait_Test extends TestCase
{
  /**
   * @var InstanceTrait
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new InstanceTraitStub;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * covers Cradle\Helper\InstanceTrait::i
   */
  public function testI()
  {
    $instance1 = InstanceTraitStub::i();
		$this->assertInstanceOf('Cradle\Helper\InstanceTraitStub', $instance1);
		
		$instance2 = InstanceTraitStub::i();
		$this->assertTrue($instance1 !== $instance2);
  }
}

if(!class_exists('Cradle\Helper\InstanceTraitStub')) {
	class InstanceTraitStub
	{
		use InstanceTrait;
	}
}
