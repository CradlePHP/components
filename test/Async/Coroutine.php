<?php //-->
/**
 * This file is part of the Cradle PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Async;

use PHPUnit\Framework\TestCase;

class Cradle_Async_Coroutine_Test extends TestCase
{
  /**
   * @var
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * @covers Cradle\Async\Coroutine::__construct
   */
  public function test__construct()
  {
    $message = null;
    try {
      new Coroutine('foo');
    } catch(AsyncException $e) {
      $message = $e->getMessage();
    }

    $this->assertEquals('Argument 1 was expecting either a Generator or callable, string used.', $message);

  }

  /**
   * @covers Cradle\Async\Coroutine::getId
   * @covers Cradle\Async\Coroutine::__construct
   */
  public function testGetId()
  {
    $noop = function() {};
    $coroutine = new Coroutine($noop);
    $this->assertEquals(spl_object_hash($noop), $coroutine->getId());

    $coroutine = new Coroutine('getcwd');
    $this->assertEquals('getcwd', $coroutine->getId());

    $routine = new RoutineStub();
    $coroutine = new Coroutine([$routine, 'foo']);
    $this->assertEquals(spl_object_hash($routine) . '::foo', $coroutine->getId());

    $coroutine = new Coroutine(['Cradle\Async\RoutineStub', 'bar']);
    $this->assertEquals('Cradle\Async\RoutineStub::bar', $coroutine->getId());
  }

  /**
   * @covers Cradle\Async\Coroutine::getValue
   * @covers Cradle\Async\Coroutine::run
   * @covers Cradle\Async\Coroutine::makeRoutine
   * @covers Cradle\Async\Coroutine::step
   */
  public function testGetValue()
  {
    $coroutine = new Coroutine(function() {
      return 'foo';
    });

    $coroutine->run();
    $this->assertEquals('foo', $coroutine->getValue());
  }

  /**
   * @covers Cradle\Async\Coroutine::isFinished
   * @covers Cradle\Async\Coroutine::run
   * @covers Cradle\Async\Coroutine::makeRoutine
   * @covers Cradle\Async\Coroutine::step
   */
  public function testIsFinished()
  {
    $coroutine = new Coroutine(function() {
      yield 'foo';
      yield 'bar';
    });

    $coroutine->run();
    $this->assertFalse($coroutine->isFinished());

    $coroutine->run();
    $coroutine->run();
    $this->assertTrue($coroutine->isFinished());
  }

  /**
   * @covers Cradle\Async\Coroutine::isStarted
   * @covers Cradle\Async\Coroutine::run
   * @covers Cradle\Async\Coroutine::makeRoutine
   * @covers Cradle\Async\Coroutine::step
   */
  public function testIsStarted()
  {
    $coroutine = new Coroutine(function() {
      yield 'foo';
    });

    $this->assertFalse($coroutine->isStarted());

    $coroutine->run();
    $this->assertTrue($coroutine->isStarted());
  }

  /**
   * @covers Cradle\Async\Coroutine::reset
   * @covers Cradle\Async\Coroutine::run
   * @covers Cradle\Async\Coroutine::makeRoutine
   * @covers Cradle\Async\Coroutine::step
   */
  public function testReset()
  {
    $coroutine = new Coroutine(function() {
      yield 'foo';
      yield 'bar';
    });

    $coroutine->run();
    $this->assertEquals('foo', $coroutine->getValue());

    $coroutine->run();
    $this->assertEquals('bar', $coroutine->getValue());

    $coroutine->reset();
    $coroutine->run();
    $this->assertEquals('foo', $coroutine->getValue());
  }
}

class RoutineStub
{
  public function foo()
  {
    return 'bar';
  }

  public static function bar()
  {
    return 'foo';
  }
}
