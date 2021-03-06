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

class Cradle_Async_AsyncException_Test extends TestCase
{
    /**
     * @var HttpException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new AsyncException;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Cradle\Async\AsyncException::forInvalidCoroutine
     */
    public function testForInvalidCoroutine()
    {
        $message = null;
        try {
            throw AsyncException::forInvalidCoroutine('foo');
        } catch(AsyncException $e) {
            $message = $e->getMessage();
        }

        $this->assertEquals('Argument 1 was expecting either a Generator or callable, string used.', $message);
    }
}
