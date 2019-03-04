<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Async;

use PHPUnit\Framework\TestCase;

class Cradle_Async_Promise_Test extends TestCase
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
     * @covers Cradle\Async\Promise::then
     * @covers Cradle\Async\Promise::__construct
     * @covers Cradle\Async\Promise::getCoroutine
     * @covers Cradle\Async\Promise::settle
     */
    public function testThen()
    {
        $handler = new AsyncHandler('noop');
        $promise = Promise::i(function($fulfill, $reject) {
            $fulfill(1);
        }, $handler);

        $test = $this;
        $called = false;
        $promise
            ->then(function ($value) {
                return $value + 1;
            })
            ->then(function ($value) use ($test, &$called) {
                $called = true;
                $test->assertEquals(2, $value);
            });

        $handler->run();
        $this->assertTrue($called);
    }

    /**
     * @covers Cradle\Async\Promise::catch
     * @covers Cradle\Async\Promise::__construct
     * @covers Cradle\Async\Promise::getCoroutine
     * @covers Cradle\Async\Promise::settle
     */
    public function testCatch()
    {
        $handler = new AsyncHandler('noop');
        $promise = Promise::i(function($fulfill, $reject) {
            $reject(1);
        }, $handler);

        $test = $this;
        $called = false;
        $promise
            ->catch(function ($value) {
                return $value + 1;
            })
            ->catch(function ($value) use ($test, &$called) {
                $called = true;
                $test->assertEquals(2, $value);
            });

        $handler->run();
        $this->assertTrue($called);
    }

    /**
     * @covers Cradle\Async\Promise::then
     * @covers Cradle\Async\Promise::catch
     * @covers Cradle\Async\Promise::finally
     * @covers Cradle\Async\Promise::getState
     * @covers Cradle\Async\Promise::__construct
     * @covers Cradle\Async\Promise::getCoroutine
     * @covers Cradle\Async\Promise::settle
     */
    public function testFinally()
    {
        $handler = new AsyncHandler('noop');
        $promise = Promise::i(function($fulfill, $reject) {
            $fulfill(1);
        }, $handler);

        $test = $this;
        $called = 0;

        $promise
            ->then(function ($x) {
                return $x + 1;
            })
            ->then(function ($x) {
                return $x + 1;
            })
            ->finally(function () use (&$promise, &$test, &$called) {
                $called ++;
                $test->assertEquals(1, $promise->getState());
            })
            ->then(function ($x) use (&$test, &$called) {
                $called ++;
                $test->assertEquals(3, $x);
                throw new Exception('fail');
            })
            ->catch(function ($message) use (&$promise, &$test, &$called) {
                $called ++;
                $test->assertEquals(2, $promise->getState());
                $test->assertEquals('fail', $message);
            });

        $handler->run();
        $this->assertEquals(3, $called);
    }

    /**
     * @covers Cradle\Async\Promise::reject
     * @covers Cradle\Async\Promise::__construct
     * @covers Cradle\Async\Promise::getCoroutine
     * @covers Cradle\Async\Promise::then
     * @covers Cradle\Async\Promise::catch
     * @covers Cradle\Async\Promise::settle
     */
    public function testReject()
    {
        $handler = new AsyncHandler('noop');

        $test = $this;
        $called = false;
        Promise::reject(1, $handler)
            ->then(null, function ($value) {
                return $value + 1;
            })
            ->catch(function ($value) use ($test, &$called) {
                $called = true;
                $test->assertEquals(2, $value);
            });

        $handler->run();
        $this->assertTrue($called);
    }

    /**
     * @covers Cradle\Async\Promise::resolve
     * @covers Cradle\Async\Promise::__construct
     * @covers Cradle\Async\Promise::getCoroutine
     * @covers Cradle\Async\Promise::then
     * @covers Cradle\Async\Promise::catch
     * @covers Cradle\Async\Promise::settle
     */
    public function testResolve()
    {
        $handler = new AsyncHandler('noop');

        $test = $this;
        $called = false;
        Promise::resolve(1, $handler)
            ->then(function ($value) {
                return $value + 1;
            })
            ->then(function ($value) use ($test, &$called) {
                $called = true;
                $test->assertEquals(2, $value);
            });

        $handler->run();
        $this->assertTrue($called);
    }

    /**
     * @covers Cradle\Async\Promise::all
     * @covers Cradle\Async\Promise::__construct
     * @covers Cradle\Async\Promise::getCoroutine
     * @covers Cradle\Async\Promise::then
     * @covers Cradle\Async\Promise::catch
     * @covers Cradle\Async\Promise::settle
     */
    public function testAll()
    {
        $handler = new AsyncHandler('noop');
        $promise1 = new Promise(function() {
            for($i = 0; $i < 10; $i++) {
                $routine = yield;
                yield $i;
            }

            $fulfill($i);
        }, $handler);

        $handler->run(function($value) {
            // echo $value . PHP_EOL;
        });


        $promise2 = new Promise(function() {
            for($i = 0; $i < 5; $i++) {
                yield $i;
            }

            $fulfill($i);
        }, $handler);

        $called = false;
        $test = $this;
        Promise::all([$promise1, $promise2], $handler)->then(null, function($values) use (&$called, $test) {
            $called = true;
            $test->assertEquals(10, $values[0]);
            $test->assertEquals(5, $values[1]);
        });

        $handler->run(function($value) {
            //echo $value . PHP_EOL;
        });

        $this->assertTrue($called);
    }

    /**
     * @covers Cradle\Async\Promise::race
     * @covers Cradle\Async\Promise::__construct
     * @covers Cradle\Async\Promise::getCoroutine
     * @covers Cradle\Async\Promise::then
     * @covers Cradle\Async\Promise::catch
     * @covers Cradle\Async\Promise::settle
     */
    public function testRace()
    {
        $handler = new AsyncHandler('noop');
        $promise1 = new Promise(function() {
            for($i = 0; $i < 10; $i++) {
                yield $i;
            }

            $fulfill($i);
        }, $handler);

        $promise2 = new Promise(function() {
            for($i = 0; $i < 5; $i++) {
                yield $i;
            }

            $fulfill($i);
        }, $handler);

        $called = false;
        $test = $this;
        Promise::race([$promise1, $promise2], $handler)->then(null, function($value) use (&$called, $test) {
            $called = true;
            $test->assertEquals(5, $value);
        });

        $handler->run();
        $this->assertTrue($called);
    }
}