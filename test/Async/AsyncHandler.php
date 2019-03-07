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

class Cradle_Async_AsyncHandler_Test extends TestCase
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
     * @covers Cradle\Async\AsyncHandler::__construct
     * @covers Cradle\Async\AsyncHandler::getChannelMap
     */
    public function test__construct()
    {
        $handler = new AsyncHandler();
        $this->assertInstanceOf('Cradle\Async\AsyncHandler', $handler);

        $handler = new AsyncHandler(function() {});
        $this->assertInstanceOf('Cradle\Async\AsyncHandler', $handler);

        $handler = new AsyncHandler('noop');
        $this->assertInstanceOf('Cradle\Async\AsyncHandler', $handler);

        $handler = new AsyncHandler('foo');
        $this->assertInstanceOf('Cradle\Async\AsyncHandler', $handler);
    }

    /**
     * @covers Cradle\Async\AsyncHandler::__construct
     * @covers Cradle\Async\AsyncHandler::getChannelMap
     * @covers Cradle\Async\AsyncHandler::add
     * @covers Cradle\Async\AsyncHandler::run
     */
    public function testRun()
    {
        $handler = new AsyncHandler('noop');
        $results = [];

        $routine1 = $handler->add(function($routine) use (&$results) {
            for($i = 0; $i < 5; $i++) {
                $results[] = $routine->getId() . '-' . $i;
                yield;
            }
        });

        $routine2 = $handler->add(function($routine) use (&$results) {
            for($i = 0; $i < 3; $i++) {
                $results[] = $routine->getId() . '-' . $i;
                yield;
            }
        });

        $handler->run();

        $this->assertEquals($routine1->getId() . '-0', $results[0]);
        $this->assertEquals($routine2->getId() . '-0', $results[1]);
        $this->assertEquals($routine1->getId() . '-1', $results[2]);
        $this->assertEquals($routine2->getId() . '-1', $results[3]);
        $this->assertEquals($routine1->getId() . '-2', $results[4]);
        $this->assertEquals($routine2->getId() . '-2', $results[5]);
        $this->assertEquals($routine1->getId() . '-3', $results[6]);
        $this->assertEquals($routine1->getId() . '-4', $results[7]);

        $handler = new AsyncHandler('noop');
        $results = [];

        $routine1 = $handler->add(function($routine) {
            for($i = 0; $i < 5; $i++) {
                yield $routine->getId() . '-' . $i;
            }
        });

        $routine2 = $handler->add(function($routine) {
            for($i = 0; $i < 3; $i++) {
                yield $routine->getId() . '-' . $i;
            }
        });

        $handler->run(function($value, $routine) use (&$results) {
            $results[] = $value;
        });

        $this->assertEquals($routine1->getId() . '-0', $results[0]);
        $this->assertEquals($routine2->getId() . '-0', $results[1]);
        $this->assertEquals($routine1->getId() . '-1', $results[2]);
        $this->assertEquals($routine2->getId() . '-1', $results[3]);
        $this->assertEquals($routine1->getId() . '-2', $results[4]);
        $this->assertEquals($routine2->getId() . '-2', $results[5]);
        $this->assertEquals($routine1->getId() . '-3', $results[6]);
        $this->assertEquals($routine1->getId() . '-4', $results[7]);
    }

    /**
     * @covers Cradle\Async\AsyncHandler::add
     * @covers Cradle\Async\AsyncHandler::kill
     * @covers Cradle\Async\AsyncHandler::__construct
     * @covers Cradle\Async\AsyncHandler::getChannelMap
     * @covers Cradle\Async\AsyncHandler::run
     */
    public function testKill()
    {
        $handler = new AsyncHandler('noop');

        $count = 0;

        $routine = $handler->add(function($routine) {
            for($i = 0; $i < 5; $i++) {
                yield [$routine->getId() , $i];
            }
        });

        $handler->run(function($value, $routine) use (&$handler, &$count) {
            $count = $value[1];
            if ($count === 3) {
                $handler->kill($value[0]);
            }
        });

        $this->assertEquals(4, $count);
    }
}
