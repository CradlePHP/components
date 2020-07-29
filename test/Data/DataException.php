<?php

namespace Cradle\Data;

use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:10:59.
 */
class Cradle_Data_DataException_Test extends TestCase
{
  /**
   * @var DataException
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new DataException;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * @covers Cradle\Data\DataException::forMethodNotFound
   * @todo   Implement testForMethodNotFound().
   */
  public function testForMethodNotFound()
  {
    $actual = null;
		
    try {
			throw DataException::forMethodNotFound('foo', 'bar');
		} catch(DataException $e) {
			$actual = $e->getMessage();
		}
		
		$expected = 'Method foo->bar() not found';
		
		$this->assertEquals($expected, $actual);
  }
}
