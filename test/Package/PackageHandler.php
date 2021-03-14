<?php

namespace Cradle\Package;

use StdClass;
use PHPUnit\Framework\TestCase;
use Cradle\Http\Request;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 13:49:45.
 */
class Cradle_Package_PackageHandler_Test extends TestCase
{
  /**
   * @var PackageHandler
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new PackageHandler;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * @covers Cradle\Package\PackageHandler::setCwd
   * @covers Cradle\Package\PackageHandler::getCwd
   */
  public function testCwd()
  {
    $thrown = false;
    try {
      $this->object->setCwd('foobar');
    } catch(PackageException $e) {
      $thrown = true;
    }

    $this->assertTrue($thrown);
    $actual = $this->object->setCwd(__DIR__);
    $this->assertInstanceOf(PackageHandler::class, $actual);

    $actual = $this->object->getCwd();
    $this->assertEquals(__DIR__, $actual);
  }

  /**
   * @covers Cradle\Package\PackageHandler::getBootstrapFileName
   */
  public function testGetBootstrapFileName()
  {
    $actual = $this->object->getBootstrapFileName();
    $this->assertEquals('bootstrap', $actual);
  }
}