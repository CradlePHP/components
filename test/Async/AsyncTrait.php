<?php //-->
/**
 * This file is part of the Cradle PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Async;

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:10:59.
 */
class Cradle_Async_AsyncTrait_Test extends TestCase
{
  /**
   * @var EventTrait
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new AsyncTraitStub;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * @covers Cradle\Async\AsyncTrait::getAsyncHandler
   */
  public function testGetAsyncHandler()
  {
    $instance = $this->object->getAsyncHandler();
    $this->assertInstanceOf('Cradle\Async\AsyncHandler', $instance);

    $instance = $this->object
      ->setAsyncHandler(new AsyncHandler('noop'))
      ->getAsyncHandler();

    $this->assertInstanceOf('Cradle\Async\AsyncHandler', $instance);
  }

  /**
   * @covers Cradle\Async\AsyncTrait::setAsyncHandler
   */
  public function testSetAsyncHandler()
  {
    $instance = $this->object->setAsyncHandler(new AsyncHandler('noop'));
    $this->assertInstanceOf('Cradle\Async\AsyncTraitStub', $instance);

    $instance = $this->object->setAsyncHandler(new AsyncHandler('noop'), true);
    $this->assertInstanceOf('Cradle\Async\AsyncTraitStub', $instance);
  }

  /**
   * @covers Cradle\Async\AsyncTrait::promise
   */
  public function testPromise()
  {
    $handler = new AsyncHandler('noop');
    $this->object->setAsyncHandler($handler, true);

    $results = [];
    $promise1 = $this->object->promise(function($fulfill, $reject) use (&$results) {
      for($i = 0; $i < 5; $i++) {
        $routine = yield;
        $results[] = 'Promise 1 - Call Task: ' . $i;
        if ($i === 2) {
          $fulfill($i);
        }
        yield $i;
      }
    })->then(function ($value) use (&$results) {
      $results[] = 'Promise 1 - Pass: ' . $value;
    });

    //exception test
    $promise2 = $this->object->promise(function($fulfill, $reject) use (&$results) {
      for($i = 0; $i < 5; $i++) {
        $routine = yield;
        $results[] = 'Promise 2 - Call Task: ' . $i;
        if ($i === 2) {
          throw new Exception('Promise 2 - Fail: ' . $i);
        }
        yield $i;
      }
    })->then(null, function ($message) use (&$results) {
      $results[] = $message;
    });

    ///promise syncronous chain
    $promise3 = $this->object->promise(1)
      ->then(function ($x) {
        return $x + 1;
      })
      ->then(function ($x) {
        return $x + 1;
      })
      ->finally(function () use (&$promise3, &$results) {
        $results[] = 'Promise 3 - Finally: ' . $promise3->getState();
      })
      ->then(function ($x) use (&$results) {
        $results[] = 'Promise 3 - Value: ' . $x;
        throw new Exception('Promise 3 - Fail');
      })
      ->catch(function ($message) use (&$results) {
        $results[] = $message;
      });

    //promise asyncronous chain
    $promise4 = $this->object->promise(function($fulfill, $reject) use (&$results) {
      for($i = 0; $i < 10; $i++) {
        $routine = yield;
        $results[] = 'Promise 4 - Call Task: ' . $i;
        if ($i === 4) {
          $fulfill($i);
        }
        yield $i;
      }
    })
    ->then(function($j) use (&$results) {
      $promise5 = $this->object->promise(function($fulfill, $reject) use ($j, &$results) {
        for($i = 0; $i < 5; $i++) {
          $routine = yield;
          $results[] = 'Promise 5 - Call Task: ' . $j . '-' . $i;
          if ($i === 2) {
            $fulfill($j . '-' . $i);
          }
          yield $i;
        }
      });

      $promise5->then(function ($x) {
        return $x . '-5';
      });

      return $promise5;
    })
    ->then(function ($x) use (&$results) {
      $results[] = 'Promise 4 - Value: ' . $x;
      throw new Exception('Promise 4 - Fail');
    })
    ->catch(function ($message) use (&$results) {
      $results[] = $message;
    })
    ->finally(function () use (&$promise4, &$results) {
      $results[] = 'Promise 4 - Finally: ' . $promise4->getState();
    });

    $results[] = 'Syncing ...';
    $handler->run();

    $this->assertEquals('Syncing ...', $results[0]);
    $this->assertEquals('Promise 1 - Call Task: 0', $results[1]);
    $this->assertEquals('Promise 2 - Call Task: 0', $results[2]);
    $this->assertEquals('Promise 3 - Finally: 1', $results[3]);
    $this->assertEquals('Promise 3 - Value: 3', $results[4]);
    $this->assertEquals('Promise 3 - Fail', $results[5]);
    $this->assertEquals('Promise 4 - Call Task: 0', $results[6]);
    $this->assertEquals('Promise 1 - Call Task: 1', $results[7]);
    $this->assertEquals('Promise 2 - Call Task: 1', $results[8]);
    $this->assertEquals('Promise 4 - Call Task: 1', $results[9]);
    $this->assertEquals('Promise 1 - Call Task: 2', $results[10]);
    $this->assertEquals('Promise 1 - Pass: 2', $results[11]);
    $this->assertEquals('Promise 2 - Call Task: 2', $results[12]);
    $this->assertEquals('Promise 2 - Fail: 2', $results[13]);
    $this->assertEquals('Promise 4 - Call Task: 2', $results[14]);
    $this->assertEquals('Promise 1 - Call Task: 3', $results[15]);
    $this->assertEquals('Promise 4 - Call Task: 3', $results[16]);
    $this->assertEquals('Promise 1 - Call Task: 4', $results[17]);
    $this->assertEquals('Promise 4 - Call Task: 4', $results[18]);
    $this->assertEquals('Promise 5 - Call Task: 4-0', $results[19]);
    $this->assertEquals('Promise 4 - Call Task: 5', $results[20]);
    $this->assertEquals('Promise 5 - Call Task: 4-1', $results[21]);
    $this->assertEquals('Promise 4 - Call Task: 6', $results[22]);
    $this->assertEquals('Promise 5 - Call Task: 4-2', $results[23]);
    $this->assertEquals('Promise 4 - Value: 4-2-5', $results[24]);
    $this->assertEquals('Promise 4 - Fail', $results[25]);
    $this->assertEquals('Promise 4 - Finally: 2', $results[26]);
    $this->assertEquals('Promise 4 - Call Task: 7', $results[27]);
    $this->assertEquals('Promise 5 - Call Task: 4-3', $results[28]);
    $this->assertEquals('Promise 4 - Call Task: 8', $results[29]);
    $this->assertEquals('Promise 5 - Call Task: 4-4', $results[30]);
    $this->assertEquals('Promise 4 - Call Task: 9', $results[31]);
  }
}

if(!class_exists('Cradle\Async\AsyncTraitStub')) {
  class AsyncTraitStub
  {
    use AsyncTrait;
  }
}
