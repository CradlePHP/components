<?php

namespace Cradle\IO\Response;

use PHPUnit\Framework\TestCase;
use Cradle\Data\Registry;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-28 at 11:36:34.
 */
class Cradle_IO_Response_ContentTrait_Test extends TestCase
{
  /**
   * @var ContentTrait
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new ContentTraitStub(array(
      'body' => 'foobar'
    ));
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * covers Cradle\IO\Response\ContentTrait::getContent
   */
  public function testGetContent()
  {
    $actual = $this->object->getContent();
    $this->assertEquals('foobar', $actual);
  }

  /**
   * covers Cradle\IO\Response\ContentTrait::hasContent
   */
  public function testHasContent()
  {
    $this->assertTrue($this->object->hasContent());
  }

  /**
   * covers Cradle\IO\Response\ContentTrait::setContent
   */
  public function testSetContent()
  {
    $instance = $this->object->setContent('foobar');

    $this->assertInstanceOf('Cradle\IO\Response\ContentTraitStub', $instance);

    $instance = $this->object->setContent(array());

    $this->assertInstanceOf('Cradle\IO\Response\ContentTraitStub', $instance);

    $instance = $this->object->setContent(false);

    $this->assertInstanceOf('Cradle\IO\Response\ContentTraitStub', $instance);

    $instance = $this->object->setContent(null);

    $this->assertInstanceOf('Cradle\IO\Response\ContentTraitStub', $instance);
  }
}

if(!class_exists('Cradle\IO\Response\ContentTraitStub')) {
  class ContentTraitStub extends Registry
  {
    use ContentTrait;
  }
}
