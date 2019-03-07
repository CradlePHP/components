<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Async;

use Closure;
use Cradle\Helper\BinderTrait;

/**
 *
 * @package  Cradle
 * @category Event
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
trait AsyncTrait
{
    use BinderTrait;

    /**
     * @var Resolver|null $globalAsyncHandler The resolver instance
     */
    protected static $globalAsyncHandler = null;

    /**
     * @var AsyncHandler|null $asyncHandler
     */
    private $asyncHandler = null;

    /**
     * Adds a task to the async queue
     *
     * @param *mixed $value
     *
     * @return Promise
     */
    public function promise($value): Promise
    {
        $handler = $this->getAsyncHandler();

        if (is_callable($value)) {
            return Promise::i($value, $handler);
        }

        return Promise::resolve($value, $handler);
    }

    /**
     * Returns an AsyncHandler object
     * if none was set, it will auto create one
     *
     * @return QueueInterface
     */
    public function getAsyncHandler(): QueueInterface
    {
        if (is_null(self::$globalAsyncHandler)) {
            //no need for a resolver because
            //there is a way to set this
            self::$globalAsyncHandler = new AsyncHandler();
        }

        if (is_null($this->asyncHandler)) {
            $this->asyncHandler = self::$globalAsyncHandler;
        }

        return $this->asyncHandler;
    }

    /**
     * Allow for a custom dispatcher to be used
     *
     * @param *QueueHandlerInterface $handler
     * @param bool                   $static
     *
     * @return AsyncTrait
     */
    public function setAsyncHandler(QueueInterface $handler, bool $static = false)
    {
        if ($static) {
            self::$globalAsyncHandler = $handler;
        }

        $this->asyncHandler = $handler;

        return $this;
    }
}
