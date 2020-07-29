<?php

namespace Cradle\Helper;

use StdClass;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:11:00.
 */
class Cradle_Helper_BinderTrait_Test extends TestCase
{
  /**
   * @var BinderTrait
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new BinderTraitStub;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * covers Cradle\Helper\BinderTrait::bindCallback
   */
  public function testBindCallback()
  {
    $trigger = new StdClass;
    $trigger->success = null;
		$trigger->test = $this;
		
		$callback = $this->object->bindCallback(function() use ($trigger) {
	  	$trigger->success = true;
			$trigger->test->assertInstanceOf('Cradle\Helper\BinderTraitStub', $this);
		});
		
		$callback();
		
		$this->assertTrue($trigger->success);
  }
}

if(!class_exists('Cradle\Helper\BinderTraitStub')) {
	class BinderTraitStub
	{
		use BinderTrait;
	}
}