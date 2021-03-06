<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Async;

/**
 * A promise represents the eventual result of an asynchronous operation.
 *
 * @package  Cradle
 * @category Async
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
interface PromiseInterface
{
    /**
     * Appends fulfillment and rejection handlers to the promise, and returns
     * a new promise resolving to the return value of the called handler.
     *
     * @param callable $onFulfilled
     * @param callable $onRejected
     *
     * @return PromiseInterface
     */
    public function then(
        callable $onFulfilled = null,
        callable $onRejected = null
    ): PromiseInterface;
}
