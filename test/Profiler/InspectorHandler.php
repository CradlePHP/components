<?php

namespace Cradle\Profiler;

use Throwable;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:11:02.
 */
class Cradle_Profiler_InspectorHandler_Test extends TestCase
{
  /**
   * @var InspectorHandler
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new InspectorHandler;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * @covers Cradle\Profiler\InspectorHandler::__call
    * @covers Cradle\Profiler\InspectorHandler::getResults
   */
  public function test__call()
  {
    $stub = new InspectorHandlerTest();

    ob_start();
    $number = $this->object->__call('call1', array());
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertFalse(!!strlen($contents));

    ob_start();
    $number = $this->object->next($stub)->__call('call2', array());
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEquals('<pre>INSPECTING Cradle\Profiler\InspectorHandlerTest->:</pre><pre>4</pre>', $contents);

    ob_start();
    $number = $this->object->next($stub)->__call('call1', array());
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEquals(
      '<pre>INSPECTING Cradle\Profiler\InspectorHandlerTest->:</pre><pre>5</pre>',
      $contents
    );

    ob_start();
    $number = $this->object->next($stub, 'x')->__call('call1', array());
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEquals(
      '<pre>INSPECTING Cradle\Profiler\InspectorHandlerTest->x:</pre><pre>4</pre>',
      $contents
    );
  }

  /**
   * @covers Cradle\Profiler\InspectorHandler::next
   */
  public function testNext()
  {
    $stub = new InspectorHandlerTest();

    ob_start();
    $number = $this->object->next($stub, 'x')->call1();
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEquals(
      '<pre>INSPECTING Cradle\Profiler\InspectorHandlerTest->x:</pre><pre>4</pre>',
      $contents
    );
  }

  /**
   * @covers Cradle\Profiler\InspectorHandler::output
   */
  public function testOutput()
  {
    ob_start();
    $this->object->output('foobar');
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEquals('<pre>foobar</pre>', $contents);

    ob_start();
    $this->object->output(true);
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEquals('<pre>*TRUE*</pre>', $contents);

    ob_start();
    $this->object->output(false);
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEquals('<pre>*FALSE*</pre>', $contents);

    ob_start();
    $this->object->output(null);
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEquals('<pre>*null*</pre>', $contents);
  }
}

if(!class_exists('Cradle\Profiler\InspectorHandlerTest')) {
  class InspectorHandlerTest
  {
    use InspectorTrait;

    public $x = 4;

    public function call1()
    {
      return $this->x + 1;
    }

    public function __call($name, $args)
    {
      return $this->x;
    }
  }
}
