<?php

namespace Cradle\IO\Response;

use PHPUnit\Framework\TestCase;

use Cradle\IO\Response;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:11:01.
 */
class Cradle_IO_ResponseTrait_Test extends TestCase
{
  /**
   * @var ResponseTrait
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new ResponseTraitStub;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * covers Cradle\IO\ResponseTrait::getResponse
   */
  public function testGetResponse()
  {
    $instance = $this->object->getResponse();
    $this->assertInstanceOf('Cradle\IO\Response', $instance);
  }

  /**
   * covers Cradle\IO\ResponseTrait::setResponse
   */
  public function testSetResponse()
  {
    $instance = $this->object->setResponse(new Response);
    $this->assertInstanceOf('Cradle\IO\Response\ResponseTraitStub', $instance);
  }
}

if(!class_exists('Cradle\IO\Response\ResponseTraitStub')) {
  class ResponseTraitStub
  {
    use ResponseTrait;
  }
}